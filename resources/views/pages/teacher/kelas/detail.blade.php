@extends('layouts.default')
@section('content')

    <h1 class="mt-4">Welcome, Teacher {{ Auth::User()->guru->name }}</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>

    <br>

    <div class="card p-3">
        @include('partials\alert')

        <p>Nama Kelas : {{ $datakelas->name_class }}</p>
        <p>Description Kelas : {{ $datakelas->description_class }}</p>

        <a href="{{ route('teacher.update.class', ['id' => $datakelas->id]) }}">Update Kelas</a>
        <form action="{{ route('teacher.delete.class', $datakelas->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm">Delete Kelas</button>
        </form>
    </div>

@endsection
