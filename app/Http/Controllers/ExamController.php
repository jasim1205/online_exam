<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\ClassList;
use App\Models\Subject;
use App\Models\ExamType;
use App\Models\Question;
use App\Models\QuestionOption;
use App\Models\User;
use Illuminate\Http\Request;
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

    public function examlist(){
        $user = User::find(CurrentUserId());
        $exam = Exam::where('class_id',$user->class_id)->get();
        return view('exam.studentexam',compact('user','exam'));
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
    //     $request->validate([
    //     'title' => 'required|string|max:255',
    //     'class_id' => 'required|integer',
    //     'subject_id' => 'required|integer',
    //     'examtype_id' => 'required|integer',
    //     'total_marks' => 'required|integer',
    //     'duration' => 'required|integer',
    //     'start_deadline' => 'required|date',
    //     'end_deadline' => 'required|date|after_or_equal:start_deadline',
        
    //     // MCQ questions validation (when examtype_id == 1)
    //     'question.*' => 'required_if:examtype_id,1|string',
    //     'option_a.*' => 'required_if:examtype_id,1|string',
    //     'option_b.*' => 'required_if:examtype_id,1|string',
    //     'option_c.*' => 'required_if:examtype_id,1|string',
    //     'option_d.*' => 'required_if:examtype_id,1|string',
    //     'option_ans.*' => 'required_if:examtype_id,1|in:1,2,3,4',
        
    //     // Descriptive questions validation (when examtype_id == 2)
    //     'descriptive_question.*' => 'required_if:examtype_id,2|string',
    //     'marks.*' => 'required|integer',
    // ]);

        
        try{
            // dd($request->all());
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
            if($exam->save()){
                if($exam->examtype_id == 1){
                    if($questions){
                        foreach($questions as $key => $question){
                            $data = new Question;
                            $data->exam_id = $exam->id;
                            $data->question = $question;
                            // $data->option_a = $request->option_a[$key];
                            // $data->option_b = $request->option_b[$key];
                            // $data->option_c = $request->option_c[$key];
                            // $data->option_d = $request->option_d[$key];
                            // $data->option_ans = $request->option_ans[$key];
                           $data->marks = $request->marks[$key];
                            //$data->save();
                            if($data->save()){
                                $options = $request->option_text;
                                foreach($options as $index => $optionText){
                                    $option = new QuestionOption;
                                    $option->question_id = $data->id;
                                    $option->option = $index + 1;
                                    $option->option_text = $optionText;
                                    $option->save();
                                }
                            }
                        }
                    }
                }else{
                    $descriptives = $request->descriptive_question;
                    if($descriptives){
                        foreach($descriptives as $key => $descriptive){

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
            $this->notice::success('Successfully Save');
            return redirect()->route('exam.index');
            // ->with($this->resMessageHtml(true,null,'Successfully Update'));
        }catch(Exception $e){
            dd($e);
            DB::Rollback();
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
    public function edit(Exam $exam)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Exam $exam)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exam $exam)
    {
        //
    }
    public function test($id){
        $user = User::find(CurrentUserId());
        $test = Exam::findOrFail(encryptor('decrypt',$id));
        return view('exam.studenttest',compact('test','user'));
    }
}
