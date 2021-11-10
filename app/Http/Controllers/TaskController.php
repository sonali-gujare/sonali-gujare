<?php

namespace App\Http\Controllers;
use App\Models\Todo;
use App\Models\Tasks;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Tasks::select('id','task_title')->get()->toArray();
        return json_encode($tasks);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'task_title' => 'required'
        ]);
        return Tasks::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Tasks::find($id);
        if($task){
            $task = Tasks::select('id','task_title')->where('id',$id)->first()->toArray();
             return json_encode($task);
        }else{
            return "Record Not Found";
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $task = Tasks::find($id);
        if($task){
            $task->update($request->all());
            return $task;
        }else{
            return "Record Not Found";
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Tasks::find($id);
        if($task){
            return Tasks::destroy($id);
        }else{
            return "Record Not Found";
        }
    }
}
