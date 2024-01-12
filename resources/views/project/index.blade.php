@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="d-flex align-items-center justify-content-between" style="margin-bottom:20px">
                <h3>Project Dashboard</h3>
                <a href="{{ route('project.create') }}" class="btn btn-primary">Tambah Project</a>
            </div>

            <table class="table table-hover">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Nama Project</th>
                        <th>Deskripsi Project</th>
                        <th>Deadline</th>
                        <th>Dibuat oleh</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                   @if($project->count() > 0)
                        @foreach($project as $rs)
                        <tr>
                            <td class="align-middle">{{ $rs->id }}</td>
                            <td class="align-middle">{{ $rs->project_name }}</td>
                            <td class="align-middle">{{ $rs->project_description }}</td>
                            <td class="align-middle">{{ $rs->deadline}}</td>
                            <td class="align-middle">{{ DB::table('users')->where('id', $rs->created_by)->value('name') }}<br>(ID:{{$rs->created_by}})</td>
                            <td class="align-middle">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button onclick="window.location.href='{{ route('project.show', $rs->id) }}';" class="btn btn-primary" style="border-radius:0px">Detail</button>
                                    <button onclick="window.location.href='{{ route('project.edit', $rs->id) }}';" class="btn btn-warning" style="border-radius:0px">Edit</button>
                                    <form action="{{ route('project.destroy', $rs->id) }}" method="POST" onsubmit="return confirm('Hapus proyek \'{{ $rs->project_name }}\' ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" style="border-radius:0px">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>

        </div>  
    </div>
</div>
@endsection