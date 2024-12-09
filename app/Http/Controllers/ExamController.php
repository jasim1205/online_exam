<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\ClassList;
use App\Models\Subject;
use App\Models\ExamType;
use App\Models\Question;
use App\Models\QuestionOption;
use App\Models\SubmissionTable;
use App\Models\AnswerSubmit;
use App\Models\User;
use Illuminate\Http\Request;
use Smalot\PdfParser\Parser;
use Illuminate\Support\Facades\Log;
use DB;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $exam = Exam::get();
        return view('exam.index',compact('exam'));
    }
    public function result_list($id){
        $exam = Exam::findOrFail(encryptor('decrypt',$id));
        $submit = SubmissionTable::where('exam_id',$exam->id)->get();
        return view('exam.adminresultlist',compact('exam','submit'));
    }

    public function individual_result($id){
        $submit = SubmissionTable::findOrFail(encryptor('decrypt',$id));
        
         $questions = Question::where('exam_id',$submit->exam_id)->get();
         // Fetch the user's submission
        // $submit = SubmissionTable::where('exam_id',$test->id)->first();
        
        // Fetch the user's submitted answers
         $answers = AnswerSubmit::where('submission_id', $submit->id)->get()->keyBy('question_id'); // Key by question_id for easy lookup
        return view('exam.individual_result',compact('submit','questions','answers'));
    }

    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classlist = ClassList::get();
        $subject = Subject::get();
        $examtype = ExamType::get();
        $question = Question::get();
        return view('exam.create',compact('classlist','subject','examtype','question'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'total_marks' => 'required|integer|min:1',
            'duration' => 'required|integer|min:1',
            'start_deadline' => 'required|date|before_or_equal:end_deadline',
            'end_deadline' => 'required|date|after_or_equal:start_deadline',
        ]);
        try {
            DB::beginTransaction();
            $exam = new Exam;
            $exam->title = $request->title;
            $exam->class_id = $request->class_id;
            $exam->subject_id = $request->subject_id;
            $exam->examtype_id = $request->examtype_id;
            $exam->total_marks = $request->total_marks;
            $exam->duration = $request->duration;
            $exam->start_deadline = $request->start_deadline;
            $exam->end_deadline = $request->end_deadline;

            $questions = $request->question;

            if ($exam->save()) {
                if ($exam->examtype_id == 1) {
                    if ($questions) {
                        foreach ($questions as $key => $question) {
                            // Save the question
                            $data = new Question;
                            $data->exam_id = $exam->id;
                            $data->question = $question;
                            $data->option_ans = $request->option_ans[$key];
                            // $data->marks = $request->marks[$key];
                            $data->marks = 2;
                            
                            if ($data->save()) {
                                // Ensure 4 options are saved for each question
                                if (isset($request->option_text[$key])) {
                                    $options = $request->option_text[$key]; // Get all options for the current question
                                    for ($i = 0; $i < 4; $i++) {
                                        // Save the options
                                        $optionText = $options[$i] ?? ''; // Get the option text or empty string if not provided
                                        $option = new QuestionOption;
                                        $option->question_id = $data->id;
                                        $option->option = $i + 1; // Option numbers (1 to 4)
                                        $option->option_text = $optionText; // Option text from the request
                                        $option->save();
                                    }}
                            }
                        }
                    }
                } else {
                    $descriptives = $request->descriptive_question;
                    if ($descriptives) {
                        foreach ($descriptives as $key => $descriptive) {
                            $data = new Question;
                            $data->exam_id = $exam->id;
                            $data->descriptive_question = $descriptive;
                            $data->marks = $request->marks[$key];
                            $data->save();
                        }
                    }
                }
            }

            DB::commit();
            $this->notice::success('Successfully Saved');
            return redirect()->route('exam.index');
            
        } catch (Exception $e) {
            DB::rollback();
            $this->notice::error('Please try again');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Exam $exam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $classlist = ClassList::get();
        $subject = Subject::get();
        $examtype = ExamType::get();
        // $question = Question::get();
        $exam = Exam::findOrFail(encryptor('decrypt',$id));
        $question = Question::where('exam_id',$exam->id)->with('option')->get();
        return view('exam.edit',compact('classlist','subject','examtype','question','exam'));

    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, Exam $exam)
    // {
    //     //
    // }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            // Retrieve the existing exam
            $exam = Exam::findOrFail(encryptor('decrypt',$id));

            // Update exam details
            $exam->title = $request->title;
            $exam->class_id = $request->class_id;
            $exam->subject_id = $request->subject_id;
            $exam->examtype_id = $request->examtype_id;
            $exam->total_marks = $request->total_marks;
            $exam->duration = $request->duration;
            $exam->start_deadline = $request->start_deadline;
            $exam->end_deadline = $request->end_deadline;

            // Delete existing questions and their options
            // Question::where('exam_id', $exam->id)->delete();
            $existingQuestions = $exam->questions;
            foreach ($existingQuestions as $existingQuestion) {
                $existingQuestion->option()->delete(); // Delete options
                $existingQuestion->delete(); // Delete question
            }

            // Save the exam
            if ($exam->save()) {
                
                    $questions = $request->question;
                    if ($questions) {
                        foreach ($questions as $key => $question) {
                            // Save the question
                            $data = new Question;
                            $data->exam_id = $exam->id;
                            $data->question = $question;
                            $data->option_ans = $request->option_ans[$key];
                            $data->marks = 2;

                            if ($data->save()) {
                                // Ensure 4 options are saved for each question
                                if (isset($request->option_text[$key])) {
                                    $options = $request->option_text[$key];
                                    for ($i = 0; $i < 4; $i++) {
                                        $optionText = $options[$i] ?? '';
                                        $option = new QuestionOption;
                                        $option->question_id = $data->id;
                                        $option->option = $i + 1;
                                        $option->option_text = $optionText;
                                        $option->save();
                                    }
                                }
                            }
                        }
                    }
               
            }

            DB::commit();
            $this->notice::success('Successfully Updated');
            return redirect()->route('exam.index');

        } catch (Exception $e) {
            DB::rollback();
            $this->notice::error('Please try again');
            return redirect()->back()->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exam $exam)
    {
        //
    }

    public function examlist(){
        $user = User::find(CurrentUserId());
        $exam = Exam::where('class_id',$user->class_id)->get();
        return view('exam.studentexam',compact('user','exam'));
    }
    public function test($id){
        $user = User::find(CurrentUserId());
        $test = Exam::findOrFail(encryptor('decrypt',$id));
        $questions = Question::where('exam_id',$test->id)->get();
        return view('exam.studenttest',compact('test','user','questions'));
    }

    // public function student_submit(Request $request){
    //     try {
    //         DB::beginTransaction();
            
    //         $data = new SubmissionTable;
    //         $data->user_id = currentUserId();
    //         $data->exam_id = $request->exam_id;
    //         $data->date = now();

    //         $questions = $request->question_id;
    //         if ($data->save()) {
    //             if ($questions) {
    //                 foreach ($questions as $key => $value) {
    //                     $answer = new AnswerSubmit;
    //                     $answer->submission_id = $data->id;
    //                     $answer->question_id = $value;

    //                     if (isset($request->option_id[$key])) {
    //                         $answer->option_id = $request->option_id[$key];
    //                     } else {
    //                         $answer->option_id = null; // Option was not selected
    //                     }
    //                     $answer->save();
    //                 }
    //             }
    //         }

    //         DB::commit();
    //         $this->notice::success('Successfully Saved');
    //         return redirect()->route('exam.index');
            
    //     } catch (Exception $e) {
    //         DB::rollback();
    //         $this->notice::error('Please try again');
    //         return redirect()->back()->withInput();
    //     }
    // }

    // public function student_submit(Request $request)
    // {
    //     try {
    //         DB::beginTransaction();

    //         // Validate that question_id and option_id are arrays
    //         $request->validate([
    //             'question_id' => 'required|array',
    //             'option_id' => 'nullable|array',
    //         ]);

    //         $data = new SubmissionTable;
    //         $data->user_id = currentUserId();
    //         $data->exam_id = $request->exam_id;
    //         $data->date = now();

    //         // Cast question_id and option_id as arrays (ensure they are arrays)
    //         $questions = $request->input('question_id', []);
    //         $options = $request->input('option_id', []);

    //         if ($data->save()) {
    //             if ($questions) {
    //                 foreach ($questions as $key => $question_id) {
    //                     $answer = new AnswerSubmit;
    //                     $answer->submission_id = $data->id;
    //                     $answer->question_id = $question_id;

    //                     // Set option_id if it exists
    //                     if (isset($options[$key])) {
    //                         $answer->option_id = $options[$key];
    //                     } else {
    //                         $answer->option_id = null; // Option was not selected
    //                     }
    //                     $answer->save();
    //                 }
    //             }
    //         }

    //         DB::commit();
    //         $this->notice::success('Successfully Saved');
    //         return redirect()->route('student.test');
            
    //     } catch (Exception $e) {
    //         DB::rollback();
    //         $this->notice::error('Please try again');
    //         return redirect()->back()->withInput();
    //     }
    // }

    public function student_submit(Request $request)
    {
        try {
            DB::beginTransaction();

            // Validate that question_id and option_id are arrays
            $request->validate([
                'question_id' => 'required|array',
                'option_id' => 'nullable|array',
            ]);

            // Create a new submission
            $data = new SubmissionTable;
            $data->user_id = currentUserId();
            $data->exam_id = $request->exam_id;
            $data->date = now();

            // Initialize total marks obtained
            $totalObtainMarks = 0;

            // Cast question_id and option_id as arrays (ensure they are arrays)
            $questions = $request->input('question_id', []);
            $options = $request->input('option_id', []);

            if ($data->save()) {
                if ($questions) {
                    foreach ($questions as $key => $question_id) {

                        // Find the question and get its details
                        $question = DB::table('questions')->where('id', $question_id)->first();

                        $answer = new AnswerSubmit;
                        $answer->submission_id = $data->id;
                        $answer->question_id = $question_id;

                        // Set option_id if it exists
                        if (isset($options[$key])) {
                            $option_primary_key = $options[$key];

                            // Retrieve the option from the question_options table using the primary key (id)
                            $option = DB::table('question_options')
                                ->where('id', $option_primary_key)
                                ->first();

                            if ($option) {
                                // Save the 'option' field value as the option_id
                                $answer->option_id = $option->option;  // Save the `option` field, not the `id`
                                //$answer->option_text = $option->option_text; // Option text if you also want to store it
                                // Compare the selected option ID against the correct answer stored in the `option_ans` field (as integer)
                                if ($option->option == $question->option_ans) {
                                    // Add the question's marks to the total obtained marks
                                    $totalObtainMarks += $question->marks;
                                }
                            } else {
                                $answer->option_id = null; // Option not found
                                //$answer->option_text = null; // No option text
                            }
                        } else {
                            $answer->option_id = null; // Option was not selected
                            //$answer->option_text = null; // No option text
                        }

                        $answer->save();
                    }
                }
                // Save the total obtained marks in the submission record
                $data->total_obtain_marks = $totalObtainMarks;
                $data->save();
            }

            DB::commit();
            $this->notice::success('Successfully Saved');
            return redirect()->route('student.exam');

        } catch (Exception $e) {
            DB::rollback();
            $this->notice::error('Please try again');
            return redirect()->back()->withInput();
        }
    }

    public function student_result($id){
        $user = User::find(CurrentUserId());
        $test = Exam::findOrFail(encryptor('decrypt',$id));
        $questions = Question::where('exam_id',$test->id)->get();
         // Fetch the user's submission
        $submit = SubmissionTable::where('user_id', currentUserId())->where('exam_id',$test->id)->first();
        
        // Fetch the user's submitted answers
        $answers = AnswerSubmit::where('submission_id', $submit->id)->get()->keyBy('question_id'); // Key by question_id for easy lookup
        return view('exam.studentresult',compact('test','user','questions','submit','answers'));
    }


    public function uploadExam(){
        return view('exam.upload');
    }

    

    public function exam_store(Request $request)
    {
        try {
            // dd($request->all);
            DB::beginTransaction();

            // Validate and retrieve the uploaded file
            if (!$request->hasFile('exam_file') || !$request->file('exam_file')->isValid()) {
                throw new Exception('Invalid file uploaded.');
            }

            $file = $request->file('exam_file');
            $parser = new Parser();
            $pdf = $parser->parseFile($file->getPathname());
            $text = $pdf->getText();

            // Parse exam details and questions
            $lines = explode("\n", $text);
            $examData = $this->extractExamData($lines); // Parse exam details
            $questions = $this->extractQuestions($lines); // Parse questions

            // Save the exam
            $exam = new Exam();
            $exam->title = $examData['title'];
            $exam->class_id = $examData['class_id'];
            $exam->subject_id = $examData['subject_id'];
            $exam->examtype_id = $examData['examtype_id'];
            $exam->total_marks = $examData['total_marks'];
            $exam->duration = $examData['duration'];
            $exam->start_deadline = $examData['start_deadline'];
            $exam->end_deadline = $examData['end_deadline'];
            // dd($exam);
            $exam->save();

            // Save questions and options
            foreach ($questions as $questionData) {
                $question = new Question();
                $question->exam_id = $exam->id;
                $question->question = $questionData['text'];
                $question->marks = $questionData['marks'];
                $question->option_ans = $questionData['correct_option'];
                //dd($questions);
                $question->save();

                foreach ($questionData['option'] as $key => $optionText) {
                    $option = new QuestionOption();
                    $option->question_id = $question->id;
                    $option->option = $key + 1;
                    // $option->option = $key + 1;
                    $option->option_text = $optionText;
                    // dd($option);
                    Log::info('Saving Option:', [
                        'question_id' => $question->id,
                        // 'option_number' => $key + 1,
                        'option' => $key + 1, 
                        'option_text' => $optionText
                    ]);
                    $option->save();
                }
            }

            DB::commit();
            return redirect()->route('exam.index')->with('success', 'Exam uploaded successfully.');

        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Extract exam details from the PDF lines.
     */
    private function extractExamData($lines)
    {
        // Extract key-value pairs from the header of the PDF
        $data = [];
        foreach ($lines as $line) {
            if (str_contains($line, 'Exam Title:')) {
                $data['title'] = trim(str_replace('Exam Title:', '', $line));
            } elseif (str_contains($line, 'Class ID:')) {
                $data['class_id'] = (int)trim(str_replace('Class ID:', '', $line));
            } elseif (str_contains($line, 'Subject ID:')) {
                $data['subject_id'] = (int)trim(str_replace('Subject ID:', '', $line));
            } elseif (str_contains($line, 'Exam Type ID:')) {
                $data['examtype_id'] = (int)trim(str_replace('Exam Type ID:', '', $line));
            } elseif (str_contains($line, 'Total Marks:')) {
                $data['total_marks'] = (int)trim(str_replace('Total Marks:', '', $line));
            } elseif (str_contains($line, 'Duration:')) {
                $data['duration'] = (int)trim(str_replace('Duration:', '', $line));
            } elseif (str_contains($line, 'Start Deadline:')) {
                $data['start_deadline'] = trim(str_replace('Start Deadline:', '', $line));
            } elseif (str_contains($line, 'End Deadline:')) {
                $data['end_deadline'] = trim(str_replace('End Deadline:', '', $line));
            }
        }
        return $data;
    }
    private function extractQuestions($lines)
    {
        $questions = [];
        $currentQuestion = null;

        foreach ($lines as $line) {
            // Detect the start of a new question
            $line = trim($line); // Clean up whitespace
            if (preg_match('/^\d+\.\s/', $line)) { // Match "1. " or "2. "
                if ($currentQuestion) {
                    $questions[] = $currentQuestion; // Save the previous question
                }
                $currentQuestion = [
                    'text' => trim(preg_replace('/^\d+\.\s/', '', $line)), // Remove question number
                    'option' => [],
                    'correct_option' => null,
                    'marks' => 2, // Default marks per question
                ];
            }
        // Detect options (e.g., "a. Berlin", "b. Paris")
            elseif (preg_match('/^[a-d]\.\s/', $line)) { // Match "a. ", "b. ", etc.
                if ($currentQuestion) {
                    $optionText = preg_replace('/^[a-d]\.\s/', '', $line); // Remove "a. ", etc.
                    $currentQuestion['option'][] = $optionText;
                    Log::info('Adding Option:', ['option_text' => $optionText]);
                }
            }
            // Detect correct answer
            elseif (str_contains($line, 'Answer:')) {
                $correctOption = strtolower(trim(str_replace('Answer:', '', $line)));
                if ($currentQuestion) {
                    $currentQuestion['correct_option'] = ord($correctOption) - ord('a') + 1; // Convert 'a' to 1, etc.
                }
            }
        }
        // Add the last question if present
        if ($currentQuestion) {
            $questions[] = $currentQuestion;
        }
        return $questions;
    }
/**
 * Extract questions and options from the PDF lines.
 */
// private function extractQuestions($lines)
// {
//     $questions = [];
//     $currentQuestion = null;

//     foreach ($lines as $line) {
//         if (preg_match('/^\d+\./', $line)) {
//             if ($currentQuestion) {
//                 $questions[] = $currentQuestion;
//             }
//             $currentQuestion = [
//                 'text' => trim(substr($line, 3)),
//                 'option' => [],
//                 'correct_option' => null,
//                 'marks' => 2, // Default marks per question
//             ];
//         } elseif (preg_match('/^[a-d]\./', $line)) {
//             $currentQuestion['option'][] = trim(substr($line, 2));
//         } elseif (str_contains($line, 'Answer:')) {
//             $correctOption = strtolower(trim(str_replace('Answer:', '', $line)));
//             $currentQuestion['correct_option'] = ord($correctOption) - ord('a') + 1; // Convert 'a' to 1, 'b' to 2, etc.
//         }
//     }
//     if ($currentQuestion) {
//         $questions[] = $currentQuestion;
//     }
//     return $questions;
// }



}
