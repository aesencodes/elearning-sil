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
                    Add Student
                </div>
                <form action="{{ route('admin.student.store') }}" method="post">
                    <button class="btn btn-success" type="submit">Submit</button>
            </div>
            <div class="card-body">
                @csrf
                <div class="row">
                    <div class="col-md-9 mx-auto">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="name" placeholder="Enter name"
                                name="name" required>
                            <label for="name">Name</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="email" placeholder="Enter email"
                                name="email" required>
                            <label for="email">Email</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" id="nis" placeholder="Enter NIS"
                                name="nis" required>
                            <label for="nis">NIS</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="password" placeholder="Enter password"
                                name="password" required>
                            <label for="password">Password</label>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    @endsection
