<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $tasks = DB::table('tasks')->where('user_id', $user->id)->get();

        return $tasks;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskRequest $request)
    {
        $user_id = Auth::user()->id;
        $data = $request->all();
        $data['user_id']=$user_id;
        $task = Task::create($data);
    
        return response()->json(['Created task' => $task], Response::HTTP_CREATED); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        $user_id = Auth::user()->id;

        return $user_id == $task->user_id ? $task : response()->json('Unauthorized action', Response::HTTP_UNAUTHORIZED); 
    }   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $user_id = Auth::user()->id;
        if ($user_id == $task->user_id) {
            $task->update($request->all());

            return response()->json(['Edited task' => $task], Response::HTTP_OK);  
        }

        return response()->json('Unauthorized action', Response::HTTP_UNAUTHORIZED); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $user_id = Auth::user()->id;
        if ($user_id == $task->user_id) {
            $task->delete();

            return response()->json(['Deleted task' => $task], Response::HTTP_OK);  
        } 
        
        return response()->json('Unauthorized action', Response::HTTP_UNAUTHORIZED); 
    }
}
