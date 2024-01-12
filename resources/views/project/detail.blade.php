@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="d-flex align-items-center justify-content-between" style="margin-bottom:20px">
                <hr />
                <a href="{{ route('project.index') }}" class="btn btn-primary">Kembali</a>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Detail Project') }}</div>
            
                <div class="card-body">
                    <table>
                        <tr>
                            <td>Nama Project</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td>{{ $project->project_name }}</td>
                        </tr>
                        <tr>
                            <td>Deskripsi Project</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td>{{ $project->project_description }}</td>
                        </tr>
                        <tr>
                            <td>Deadline Project</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td>{{ $project->deadline }}</td>
                        </tr>
                        <tr>
                            <td>Project dibuat pada</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td>{{ $project->created_at }}</td>
                        </tr>
                        <tr>
                            <td>Project dibuat oleh</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td>{{ DB::table('users')->where('id', $project->created_by)->value('name') }} (ID : {{ $project->created_by }})</td>
                        </tr>
                        <tr>
                            <td>Project diupdate pada</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td>{{ $project->updated_at }}</td>
                        </tr>
                        <tr>
                            <td>Project diupdate oleh</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td>{{ DB::table('users')->where('id', $project->updated_by)->value('name') }} (ID : {{ $project->updated_by }})</td>
                        </tr>

                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="d-flex align-items-center justify-content-between" style="margin:35px 0px 15px 0px">
                <h3>Project Files</h3>
            </div>

            
                <form action="{{ route('file.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                    <div class="d-flex align-items-center justify-content-between" style="margin:0px 0px 15px 0px">
                
                        <h6>Upload Project</h6>
                        <input type="file" name="file" class="form-control" placeholder="Upload File" required />
                        <input type="hidden" name="project_id"  value={{ $project->id }}>
                        <button type="submit" class="btn btn-primary" style="margin:0px 0px 0px 15px">Upload</button>

                    </div>
                </form>
            

            <table class="table table-hover">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Nama File</th>
                        <th>Mime Type</th>
                        <th>Diupload oleh</th>
                        <th>Diupload pada</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if($file->count() > 0)
                        @foreach($file as $rs)
                            @if($rs->project_id === $project->id)
                                <tr>
                                    <td class="align-middle">{{ $rs->id }}</td>
                                    <td class="align-middle">{{ $rs->file }}</td>
                                    <td class="align-middle">{{ $rs->mime_type }}</td>
                                    <td class="align-middle">{{ DB::table('users')->where('id', $rs->created_by)->value('name') }}<br>(ID:{{$rs->created_by}})</td>
                                    <td class="align-middle">{{ $rs->created_at }}</td>
                                    <td class="align-middle">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                        <button onclick="window.location.href='{{ route('file.show', $rs->id) }}';" class="btn btn-primary" style="border-radius:0px">Detail</button>
                                        <button onclick="window.location.href='{{ route('file.edit', $rs->id) }}';" class="btn btn-warning" style="border-radius:0px">Edit</button>
                                        <form action="{{ route('file.destroy', $rs->id) }}" method="POST" onsubmit="return confirm('Hapus file \'{{ $rs->file }}\' ?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger" style="border-radius:0px">Hapus</button>
                                        </form>
                                    </div>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection