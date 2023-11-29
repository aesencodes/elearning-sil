@extends('layouts.default')
@section('content')

    @include('partials.alert')

    <div class="d-flex flex-wrap justify-content-between">
        <div>
            <h1 class="mt-4 ms-2">Buat Materi</h1>
            <ol class="breadcrumb mb-4 ms-2">
                <li class="breadcrumb-item active">Materi baru</li>
            </ol>
        </div>
    </div>

    <div class="card p-3">
        <form action="{{ route('teacher.create.post.materi') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="nameClass">Nama Materi</label>
                <input type="text" class="form-control" id="nameClass" name="name" placeholder="Masukan judul materi">
                @error('name_class') <small id="nameClass" class="form-text text-muted text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="form-group mt-3">
                <label for="descriptionClass">Deskripsi Materi</label>
                <textarea type="text" class="form-control" id="descriptionClass" name="desc" placeholder=""></textarea>
                @error('name_class') <small id="descriptionClass" class="form-text text-muted text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="form-group mt-3">
                <label for="formFile" class="form-label">Upload Materi</label>
                <input class="form-control" type="file" id="formFile" name="file">
            </div>

            <input type="hidden" name="id" value="{{ $id }}">
            <input type="hidden" name="guru_id" value="{{ $guru_id }}">

            <button type="submit" class="btn btn-primary mt-3">Tambah Materi</button>
        </form>
    </div>
@endsection
