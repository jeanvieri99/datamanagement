@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="d-flex align-items-center justify-content-between" style="margin-bottom:20px">
                <hr />
                <a href="{{ route('project.show', $file->project_id) }}" class="btn btn-primary">Kembali</a>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Detail Project') }}</div>
            
                <div class="card-body">
                    <table>
                        <tr>
                            <td>File ID</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td>{{ $file->id}}</td>
                        </tr>
                        <tr>
                            <td>Project ID</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td>{{ $file->project_id}} - {{ DB::table('projects')->where('id', $file->project_id)->value('project_name') }}</td>
                        </tr>
                        <tr>
                            <td>File</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td><a href="{{ route('download', ['path' => 'storage/'.$file->id.'/'.$file->file]) }}">{{ $file->file}}</a></td>
                        </tr>
                        <tr>
                            <td>Mime Type</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td>{{ $file->mime_type}}</td>
                        </tr>
                        <tr>
                            <td>File diupload oleh</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td>{{ DB::table('users')->where('id', $file->created_by)->value('name') }} (ID : {{ $file->created_by }})</td>
                        </tr>
                        <tr>
                            <td>File diupload pada</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td>{{ $file->created_at}}</td>
                        </tr>
                        <tr>
                            <td>File diupdate oleh</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td>{{ DB::table('users')->where('id', $file->updated_by)->value('name') }} (ID : {{ $file->updated_by }})</td>
                        </tr>
                        <tr>
                            <td>File diupdate pada</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td>{{ $file->updated_at}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection