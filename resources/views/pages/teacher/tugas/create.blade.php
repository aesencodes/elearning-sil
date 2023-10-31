@extends('layouts.default')
@section('content')

    @include('partials.alert')

    <div class="d-flex flex-wrap justify-content-between">
        <div>
            <h1 class="mt-4 ms-2">Buat Tugas.</h1>
            <ol class="breadcrumb mb-4 ms-2">
                <li class="breadcrumb-item active">Buat Tugas.</li>
            </ol>
        </div>
    </div>

    <div class="card p-3">
        <form action="{{ route('teacher.create.post.tugas') }}" method="post">
            @csrf
            <div class="form-group mt-3">
                <label for="descriptionClass">Judul Tugas</label>
                <textarea type="text" class="form-control" id="descriptionClass" name="judul_tugas" placeholder="Masukan Tugas."></textarea>
                @error('name_class') <small id="descriptionClass" class="form-text text-muted text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="form-group mt-3">
                <label for="descriptionClass">Deskripsi Tugas</label>
                <textarea type="text" class="form-control" id="descriptionClass" name="deskripsi_tugas" placeholder="Masukan Tugas."></textarea>
                @error('name_class') <small id="descriptionClass" class="form-text text-muted text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="form-group">
                <label for="upload_file" class="control-label col-sm-3">Upload File Tugas</label>
                <div class="col-sm-9">
                     <input class="form-control" type="file" name="file_upload_tugas" id="upload_file">
                </div>
           </div>
            <input type="submit" class="btn btn-primary mt-3" value="Buat Tugas">
        </form>
    </div>

@endsection
