<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subject = Subject::get();
        return view('subject.index',compact('subject'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('subject.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            // Validate the incoming request data
            $validatedData = $request->validate([
                'name' => 'required|unique:subjects,name', // Adjust the table and column name as per your database
            ]);
            $data=new Subject;
            $data->name=$request->name;
            if($data->save()){
                $this->notice::success('Successfully saved');
                return redirect()->route('subject.index');
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
    public function show(Subject $subject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $subject=Subject::findOrFail(encryptor('decrypt',$id));
        return view('subject.edit',compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        try{
            // Validate the incoming request data
            $validatedData = $request->validate([
                'name' => 'required|unique:subjects,name,'.encryptor('decrypt',$id) // Adjust the table and column name as per your database
            ]);
            $data=Subject::findOrFail(encryptor('decrypt',$id));
            $data->name=$request->name;
            if($data->save()){
                $this->notice::success('Successfully Updated');
                return redirect()->route('subject.index');
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
        $data=Subject::findOrFail(encryptor('decrypt',$id));
        if($data->delete()){
            $this->notice::success('Successfully Deleted');
            return redirect()->route('subject.index');
        }
    }
}
