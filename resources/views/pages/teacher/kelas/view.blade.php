@extends('layouts.default')
@section('content')

    <h1 class="mt-4">Welcome, Teacher {{ Auth::User()->guru->name }}</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>

    <br>

    @include('partials\alert')

    <div class="d-flex flex flex-warp">
        @forelse($dataKelas as $dkelas)
            <div class="card ms-2 me-2" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">{{ $dkelas->name_class }}</h5>
{{--                    <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>--}}
                    <p class="card-text">{{ $dkelas->description_class }}</p>
                    <a href="{{ route('teacher.detail.class', ['id' => $dkelas->id]) }}" class="card-link">Lihat Kelas</a>
                </div>
            </div>
        @empty
            <div class="alert alert-danger alert-dismissible fade show mg-t-20" role="alert">
                Kamu belum membuka kelas.
            </div>
        @endforelse
    </div>

@endsection
