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
    public function __construct()
    {
        $this->middleware('auth:api',['except'=>'login']); //not going to use on login
    }
    public function index()
    {
        $tasks = Tasks::select('id','task_title')->get()->toArray();
        return response(array(
            'message' => 'Tasks Fetch Successfully.',
            'data' => $tasks
         ), 201);
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
        $task = Tasks::create($request->all());
        return response(array(
            'message' => 'Task Successfully Ceated.',
            'data' => $task
         ), 201);
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
            return response(array(
                'message' => 'Task Successfully Fetch.',
                'data' => $task
             ), 201);
        }else{
            return response(array(
                'message' => 'Your Requested Task Not Found.',
             ), 410);
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
            return response(array(
                'message' => 'Task Successfully Deleted.',
                'data' => $task
             ), 201);
        }else{
            return response(array(
                'message' => 'Your Requested Task Not Found.',
             ), 410);
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
            return response(array(
                'message' => 'Task Successfully Deleted.'
             ), 201);
        }else{
            return response(array(
                'message' => 'Your Requested Task Not Found.',
             ), 410);
        }
    }
}
