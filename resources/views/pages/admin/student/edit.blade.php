@extends('layouts.default')
@section('content')
    <h1 class="mt-4">Student Management</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
    <div class="row">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <i class="fas fa-table me-1"></i>
                    Edit Student
                </div>
                <form action="{{ route('admin.teacher.update', $student->id) }}" method="POST">
                    <button class="btn btn-primary" type="submit">Update</button>
            </div>
            <div class="card-body">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-9 mx-auto">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="name" placeholder="" value="{{ $student->name }}"
                                name="name" required>
                            <label for="name">Nama</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="email" placeholder="" value="{{ $email }}"
                                name="email" required>
                            <label for="email">Email</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" id="nis" placeholder="" value="{{ $student->nis }}"
                                name="nis" required>
                            <label for="nis">NIS</label>
                        </div>
                        <div class="form-floating mb-3">
                            <a href="" class="btn btn-danger"> Reset Password </a>
                    </div>
                </div>
                </form>
            </div>
        </div>
    @endsection
