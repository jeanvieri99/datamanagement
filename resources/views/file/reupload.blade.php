@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="d-flex align-items-center justify-content-between" style="margin-bottom:20px">
            <h3>Reupload File</h3>
            <a href="{{ route('project.show', $file->project_id) }}" class="btn btn-primary">Kembali</a>
        </div>

        <form action="{{ route('file.update', $file->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row mb-3">
                <label class="col-md-4 col-form-label text-md-end">{{ __('Current File') }}</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" placeholder="Type project description" value="{{ $file->file}}" disabled />
                    </div>
            </div>

            <div class="row mb-3">
                <label for="file" class="col-md-4 col-form-label text-md-end">{{ __('Upload New File') }}</label>
                    <div class="col-md-6">
                        <input type="file" name="file" class="form-control" placeholder="Upload File" required />
                    </div>
            </div>

            <div class="row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Reupload File') }}
                    </button>
                </div>
            </div>
    </div>
</div>
@endsection