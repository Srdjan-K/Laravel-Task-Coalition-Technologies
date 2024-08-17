<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $projects = Project::latest()->paginate(5);

        return view('projects.index', [ 'projects' => $projects ] );

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
        // Validate The Fields
        $fields = $request->validate([
            'title' => ['required','max:255'],
            'descr' => ['required','max:1000'],
        ]);

        $project = Project::create([
            'title' => $request->title,
            'descr' => $request->descr,
        ]);

        // Redirect
        return back()->with('success','Your Project was created. ID : ' . $project->id );
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //

        return view('projects.show', ['project'=>$project] );

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        //

        return view('projects.edit', ['project' => $project]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        //
        // Validate
        $request->validate([
            'title' => ['required', 'max:255'],
            'descr' => ['required', 'max:1000'],
        ]);

        // Update the post
        $project->update([
            'title' => $request->title,
            'descr' => $request->descr,
            
        ]);

        // Redirect to dashboard
        return redirect()->route('projects.index')->with('success', 'Your Project : ' . $request->title . ' , was updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        //
        // Delete specific PROJECT from DataBase
        $project->delete();

        return redirect()->route('projects.index')->with('delete', 'Your PROJECT was DELETED ! Project Title : ' . $project->title );

    }
}
