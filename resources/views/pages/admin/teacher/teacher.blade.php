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
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">NUPTK</th>
                            <th scope="col">Nama</th>
                            <th scope="col"></th>
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
                                    <a href="" class="btn btn-warning btn-sm mb-1">Edit</a>
                                    <a href="{{ route('pages.admin.teacher.destroy') }} / {{ $item->id }}" class="btn btn-danger btn-sm mb-1">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endsection
