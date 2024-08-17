<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //

        if( Session::has('tasks_project_id') ){
            $project_id = Session::get('tasks_project_id');
        }else{
            $project_id = "";
        }

        if( isset($project_id) &&  !empty($project_id)  &&  $project_id !== "null"  &&  $project_id != "all" ){
            $tasks = Task::where('project_id', $project_id )->latest()->paginate(5);
        }elseif( isset($project_id) &&  $project_id === "null"  ){
            $tasks = Task::whereNull('project_id' )->latest()->paginate(5);
        }else{
            $tasks = Task::latest()->paginate(5);
        }

        $projects = Project::all();

        return view('tasks.index', [ 'tasks' => $tasks, 'projects' => $projects ] );

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $priority = NULL;
        $project_id = NULL;

        // Validate The Fields
        $fields = $request->validate([
            'title' => ['required','max:255'],
            'descr' => ['required','max:30000'],
        ]);

        $priority = ( isset($request->priority) && $request->priority > 0 ) ? intval($request->priority) : NULL;
        $project_id = ( isset($request->project_id) && $request->project_id > 0 ) ? intval($request->project_id) : NULL;

        if ( $priority != NULL && $priority < 0 ) {
            // The record exists
            return redirect()->route('tasks.index')->with('error','You can NOT have negative priority ! ');
        }

        $task_already_exists = Task::where('priority', $priority )->first();

        if ( $task_already_exists !== NULL  &&  $task_already_exists->priority !== NULL ) {
            // The record exists
            return redirect()->route('tasks.index')->with('error','You can NOT have tasks with same priority num. You have task with same priority. Task : ' . $task_already_exists->title . ' , and used priority : ' . $task_already_exists->priority );
        }


        // Update the post
        $task = Task::create([
            'title' => $request->title,
            'descr' => $request->descr,
            'priority' => $priority,
            'project_id' => $project_id,
            
        ]);

        // Redirect
        return redirect()->route('tasks.index')->with('success','Your Task was created. ID : ' . $task->id );

    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //

        return view('tasks.show', ['task'=>$task] );

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
        $projects = Project::all();

        return view('tasks.edit', ['task' => $task , 'projects' => $projects ] );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        //
        $priority = NULL;
        $project_id = NULL;

        // Validate The Fields
        $fields = $request->validate([
            'title' => ['required','max:255'],
            'descr' => ['required','max:30000'],
        ]);

        $priority = ( isset($request->priority) && $request->priority > 0 ) ? intval($request->priority) : NULL;
        $project_id = ( isset($request->project_id) && $request->project_id > 0 ) ? intval($request->project_id) : NULL;

        if ( $priority != NULL && $priority < 0 ) {
            // The record exists
            return redirect()->route('tasks.index')->with('error','You can NOT have negative priority ! ');
        }

        $task_already_exists = Task::where('priority', $priority )->first();

        if ( $task_already_exists !== NULL  &&  $task_already_exists->priority !== NULL  &&  $task_already_exists->id != $task->id ) {
            // The record exists
            return redirect()->route('tasks.index')->with('error','You can NOT have tasks with same priority num. You have task with same priority. Task : ' . $task_already_exists->title . ' , and used priority : ' . $task_already_exists->priority );
        }

        // Update the post
        $task->update([
            'title' => $request->title,
            'descr' => $request->descr,
            'priority' => $priority,
            'project_id' => $project_id,
            
        ]);

        // Redirect to dashboard
        return redirect()->route('tasks.index')->with('success', 'Your Task : ' . $request->title . ' , was updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //
        // Delete specific TASK from DataBase
        $task->delete();

        return redirect()->route('tasks.index')->with('delete', 'Your TASK was DELETED ! Task Title : ' . $task->title );

    }

    public function project(Request $request){

        $project_id = "";

        if( isset($request->project_id)  && $request->project_id == "all" ){
            if( Session::has('tasks_project_id') ){
                Session::forget('tasks_project_id');
            }
            $project_id = "all";
        }elseif(  isset($request->project_id)  && $request->project_id == "null"  ){
            Session::put('tasks_project_id', "null" );
            $project_id = "null";
        }elseif(  isset($request->project_id) ){
            Session::put('tasks_project_id', $request->project_id );
            $project_id = $request->project_id;
        }elseif(  !isset($request->project_id)  && Session::has('tasks_project_id')  ){
            $project_id = Session::get('tasks_project_id' );
        }elseif(  !isset($request->project_id)  && !Session::has('tasks_project_id')  ){
            $project_id = "";
        }else{
            $project_id = "";
        }


        if( isset($project_id) &&  !empty($project_id)  &&  $project_id !== "null"  &&  $project_id != "all" ){
            $tasks = Task::where('project_id', $project_id )->latest()->paginate(5);
        }elseif( isset($project_id) &&  $project_id === "null"  ){
            $tasks = Task::whereNull('project_id' )->latest()->paginate(5);
        }else{
            $tasks = Task::latest()->paginate(5);
        }
        

        $projects = Project::all();

        return view('tasks.index', [ 'tasks' => $tasks, 'projects' => $projects, 'project_id' => $request->project_id ] );

    }


}
