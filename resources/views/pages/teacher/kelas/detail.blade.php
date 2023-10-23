@extends('layouts.default')
@section('content')

    <h1 class="mt-4">Welcome, Teacher {{ Auth::User()->guru->name }}</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>

    <br>

    <div class="card p-3">
        <p>Nama Kelas : {{ $datakelas->name_class }}</p>
        <p>Description Kelas : {{ $datakelas->description_class }}</p>
    </div>

@endsection
