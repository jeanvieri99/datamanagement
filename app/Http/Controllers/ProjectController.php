<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Project_file;
use App\Models\Project;

class ProjectController extends Controller
{
     
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $project = Project::orderBy('created_at', 'DESC')->get();

        return view('project.index', compact('project'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('project.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Project::create([
            'project_name' => $request->project_name,
            'project_description' => $request->project_description,
            'deadline' => $request->deadline,
            'created_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id,
        ]);

        return redirect()->route('project.index');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $project = Project::findOrFail($id);
        $file = Project_file::orderBy('created_at', 'DESC')->get();
 
        return view('project.detail', compact('project','file'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $project = Project::findOrFail($id);
 
        return view('project.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $project = Project::findOrFail($id);
 
        $project->update([
            'project_name' => $request->project_name,
            'project_description' => $request->project_description,
            'deadline' => $request->deadline,
            'updated_by' => Auth::user()->id,
        ]);
 
        return redirect()->route('project.index')->with('success', 'Project berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $project = Project::findOrFail($id);
 
        $project->delete();
 
        return redirect()->route('project.index')->with('success', 'Project berhasil dihapus!');
    }

    
}
