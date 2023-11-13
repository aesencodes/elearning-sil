@extends('layouts.default')
@section('content')

    @include('partials.alert')

    <div class="d-flex flex-wrap justify-content-between">
        <div>
            <h1 class="mt-4 ms-2">Perbarui Data Kelas.</h1>
            <ol class="breadcrumb mb-4 ms-2">
                <li class="breadcrumb-item active">Perbarui kelas Untuk siswamu.</li>
            </ol>
        </div>
    </div>

    <div class="card p-3">
        <form action="{{ route('teacher.update.post.class') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="nameClass">Nama Kelas</label>
                <input type="text" class="form-control" id="nameClass" name="name_class" value="{{ $datakelas->name_class }}" placeholder="Masukan nama kelas kamu.">
                @error('name_class') <small class="form-text text-muted text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="form-group mt-3">
                <label for="descriptionClass">Deskripsi Kelas</label>
                <textarea type="text" class="form-control" id="descriptionClass" name="description_class" placeholder="Masukan deskripsi kelas kamu.">{{ $datakelas->description_class }}</textarea>
                @error('name_class') <small class="form-text text-muted text-danger">{{ $message }}</small> @enderror
            </div>
            <input value="{{ $datakelas->id }}" name="id_class" style="display: none;">
            <input type="submit" class="btn btn-primary mt-3" value="Perbarui Kelas">
        </form>
    </div>

@endsection
