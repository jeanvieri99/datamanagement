@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="d-flex align-items-center justify-content-between" style="margin-bottom:20px">
            <h3>Edit Project</h3>
            <a href="{{ route('project.index') }}" class="btn btn-primary">Kembali</a>
        </div>

        <form action="{{ route('project.update', $project->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row mb-3">
                <label for="project_name" class="col-md-4 col-form-label text-md-end">{{ __('Nama Project') }}</label>
                    <div class="col-md-6">
                        <input type="text" name="project_name" class="form-control" value="{{ $project->project_name }}" placeholder="Type project name" required/>
                    </div>
            </div>

            <div class="row mb-3">
                <label for="project_description" class="col-md-4 col-form-label text-md-end">{{ __('Deskripsi Project') }}</label>
                    <div class="col-md-6">
                        <input type="text" name="project_description" class="form-control" value="{{ $project->project_description }}" placeholder="Type project description" required/>
                    </div>
            </div>

            <div class="row mb-3">
                <label for="deadline" class="col-md-4 col-form-label text-md-end">{{ __('Project Deadline') }}</label>
                    <div class="col-md-6">
                        <input type="datetime-local" value="{{ $project->deadline }}" name="deadline" required/>
                    </div>
            </div>
            
            <div class="row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Simpan Perubahan') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection