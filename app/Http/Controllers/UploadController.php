<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str; 
use App\Models\Project_file;
use App\Models\Project;

class UploadController extends Controller
{
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
        $project = Project::orderBy('created_at', 'DESC')->get();

        return view('file.upload', compact('project'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
        {
            Project_file::create([
                'file' => $request->file->getClientOriginalName(),
                'project_id' => $request->project_id,
                'mime_type' => Str::limit($request->file->getClientMimeType(),45),
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ]);

            $fullpath = 'storage/';
            $request->file->storeAs($fullpath.Project_file::latest()->first()->id, $request->file->getClientOriginalName());

            return back();
        }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $file= Project_file::findOrFail($id);


        return view('file.property', compact('file'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $file = Project_file::findOrFail($id);
 
        return view('file.reupload', compact('file'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $file = Project_file::findOrFail($id);
        $fullpath = 'storage/';
        
        $request->file->storeAs($fullpath.$id, $request->file->getClientOriginalName());

        $file->update([
            'file' => $request->file->getClientOriginalName(),
            'mime_type' => Str::limit($request->file->getClientMimeType(),45),
            'updated_by' => Auth::user()->id,
        ]);
 
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $file = Project_file::findOrFail($id);

        $folderPath = 'storage/' . $id;
        if (Storage::exists($folderPath)) {
            Storage::deleteDirectory($folderPath);
        }
 
        $file->delete();
 
        return back();
    }
}
