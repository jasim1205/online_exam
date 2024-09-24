<?php

namespace App\Http\Controllers;

use App\Models\ExamType;
use Illuminate\Http\Request;

class ExamTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $examtype = ExamType::get();
        return view('examtype.index',compact('examtype'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('examtype.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            // Validate the incoming request data
            $validatedData = $request->validate([
                'name' => 'required|unique:exam_types,name', // Adjust the table and column name as per your database
            ]);
            $data=new ExamType;
            $data->name=$request->name;
            if($data->save()){
                $this->notice::success('Successfully saved');
                return redirect()->route('examtype.index');
            }
        }catch(Exception $e){
            //dd($e);
            $this->notice::error('Please try again');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ExamType $examType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $examtype=ExamType::findOrFail(encryptor('decrypt',$id));
        return view('examtype.edit',compact('examtype'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        try{
            // Validate the incoming request data
            $validatedData = $request->validate([
                'name' => 'required|unique:exam_types,name,'.encryptor('decrypt',$id) // Adjust the table and column name as per your database
            ]);
            $data=ExamType::findOrFail(encryptor('decrypt',$id));
            $data->name=$request->name;
            if($data->save()){
                $this->notice::success('Successfully Updated');
                return redirect()->route('examtype.index');
            }
        }catch(Exception $e){
            //dd($e);
            $this->notice::error('Please try again');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data=ExamType::findOrFail(encryptor('decrypt',$id));
        if($data->delete()){
            $this->notice::success('Successfully Deleted');
            return redirect()->route('examtype.index');
        }
    }
}
