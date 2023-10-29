@extends('layouts.default')
@section('content')

    @include('partials\alert')

    <div class="d-flex flex-wrap justify-content-between">
        <div>
            <h1 class="mt-4 ms-2">Buat Tugas.</h1>
            <ol class="breadcrumb mb-4 ms-2">
                <li class="breadcrumb-item active">Buat Tugas.</li>
            </ol>
        </div>
    </div>

    <div class="card p-3">
        <form action="{{ route('teacher.create.post.class') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="nameClass">Jenis Tugas</label>
                <select class="form-select" aria-label="Default select example">
                    <option selected>Jenis Tugas</option>
                    <option value="1">Pilihan Ganda</option>
                    <option value="2">Essay</option>
                    <option value="3">Campuran</option>
                  </select>
                @error('name_class') <small id="nameClass" class="form-text text-muted text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="form-group mt-3">
                <label for="descriptionClass">Isi Tugas</label>
                <textarea type="text" class="form-control" id="descriptionClass" name="description_class" placeholder="Masukan Tugas."></textarea>
                @error('name_class') <small id="descriptionClass" class="form-text text-muted text-danger">{{ $message }}</small> @enderror
            </div>
            <input type="submit" class="btn btn-primary mt-3" value="Buat Tugas">
        </form>
    </div>

@endsection
