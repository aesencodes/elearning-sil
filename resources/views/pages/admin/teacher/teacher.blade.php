@extends('layouts.default')
@section('content')
    <h1 class="mt-4">Teacher Management</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
    <div class="row">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <i class="fas fa-table me-1"></i>
                    Teachers
                </div>
                <a href="{{ route('admin.teacher.create') }}" class="btn btn-primary">Add new Teacher</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" style="overflow-x: auto">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">NUPTK</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($teacher as $item)
                                <tr>
                                    <th scope="row" class="col-2">
                                        {{ $item->seq_id }}
                                    </th>
                                    <td class="col-3">{{ $item->nuptk }}</td>
                                    <td class="col-4">{{ $item->name }}</td>
                                    <td class="col-2">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.teacher.edit', $item->id) }}" class="btn btn-warning btn-sm me-2">Edit</a>
                                            <form action="{{ route('admin.teacher.destroy', $item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endsection
