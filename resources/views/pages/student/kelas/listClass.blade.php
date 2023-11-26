@extends('layouts.default')
@section('content')

    @include('partials.alert')

    @error('code_class')
        <div class="alert alert-danger alert-dismissible fade show mg-t-20 mt-3" role="alert">
            {{ $message }}
        </div>
    @enderror


    <div class="d-flex flex-wrap justify-content-between">
        <div>
            <h1 class="mt-4 ms-2">Daftar Kelas.</h1>
            <ol class="breadcrumb mb-4 ms-2">
{{--                <li class="breadcrumb-item active">Daftar kelas yang telah kamu buat.</li>--}}
            </ol>
        </div>
        <div class="d-flex align-items-center">
{{--            <a href="{{ route('teacher.create.class') }}" class="btn btn-primary pe-4 ps-4">Buat Kelas</a>--}}
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Gabung Kelas
            </button>
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
                    <a href="{{ route('student.detail.class', ['id' => $dkelas->id]) }}" class="card-link">Lihat Kelas</a>
                </div>
            </div>
        @empty
            <div class="alert alert-danger alert-dismissible fade show mg-t-20 w-100" role="alert">
                Kamu belum bergabung dalam kelas.
            </div>
        @endforelse
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Gabung Kelas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('student.join.class') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
{{--                            <label for="code_class class="form-label">Kode Kelas</label>--}}
                            <input type="text" name="code_class" class="form-control" placeholder="Masukan Kode Kelas" id="code_class">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" value="Gabung Kelass">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
