@extends('layouts.default')
@section('content')

    @include('partials.alert')

    <div class="d-flex flex-wrap justify-content-between">
        <div>
            <h1 class="mt-4 ms-2">Daftar Kelas.</h1>
            <ol class="breadcrumb mb-4 ms-2">
                <li class="breadcrumb-item active">Daftar kelas yang telah kamu buat.</li>
            </ol>
        </div>
        <div class="d-flex align-items-center">
            <a href="{{ route('teacher.create.class') }}" class="btn btn-primary pe-4 ps-4">Buat Kelas</a>
        </div>
    </div>
    <hr class="m-2 mb-4">

    <div class="d-flex flex flex-warp">
        @forelse($dataKelas as $dkelas)
            <div class="card ms-2 me-2" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">{{ $dkelas->name_class }}</h5>
                    {{-- <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>--}}
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
