<?php

namespace App\Http\Controllers;

use App\Models\ClassList;
use Illuminate\Http\Request;

class ClassListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $class = ClassList::get();
        return view('class.index',compact('class'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('class.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            // Validate the incoming request data
            $validatedData = $request->validate([
                'name' => 'required|unique:class_lists,name', // Adjust the table and column name as per your database
            ]);
            $data=new ClassList;
            $data->name=$request->name;
            if($data->save()){
                $this->notice::success('Successfully saved');
                return redirect()->route('classlist.index');
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
    public function show(ClassList $classList)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $class=ClassList::findOrFail(encryptor('decrypt',$id));
        return view('class.edit',compact('class'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try{
            // Validate the incoming request data
            $validatedData = $request->validate([
                'name' => 'required|unique:class_lists,name,'.encryptor('decrypt',$id) // Adjust the table and column name as per your database
            ]);
            $data=ClassList::findOrFail(encryptor('decrypt',$id));
            $data->name=$request->name;
            if($data->save()){
                $this->notice::success('Successfully Updated');
                return redirect()->route('classlist.index');
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
        $data=ClassList::findOrFail(encryptor('decrypt',$id));
        if($data->delete()){
            $this->notice::success('Successfully Deleted');
            return redirect()->route('classlist.index');
        }
    }
}
