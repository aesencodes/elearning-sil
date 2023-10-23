@extends('layouts.default')
@section('content')

    <h1 class="mt-4">Welcome, Teacher {{ Auth::User()->guru->name }}</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>

    <br>

    <div class="card">
        @include('partials\alert')

        <form action="{{ route('teacher.update.post.class') }}" method="post">
            @csrf
            <div class="form-group">
                <label>Name Class</label>
                <input type="text" name="name_class" value="{{ $datakelas->name_class }}">
                @error('name_class') <p class="text-danger">{{ $message }}</p> @enderror
            </div>
            <div class="form-group">
                <label>Description Class</label>
                <input type="text" name="description_class" value="{{ $datakelas->description_class }}">
                @error('description_class') <p class="text-danger">{{ $message }}</p> @enderror
            </div>
            <input value="{{ $datakelas->id }}" name="id_class" style="display: none;">
            <input type="submit" class="btn btn-primary" value="Perbarui Kelas">
        </form>
    </div>

@endsection
