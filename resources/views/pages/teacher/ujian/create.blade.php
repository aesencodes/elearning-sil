@extends('layouts.default')
@section('content')

    @include('partials.alert')

    <div class="d-flex flex-wrap justify-content-between">
        <div class="mb-4">
            <h1 class="mt-4 ms-2">Buat Ujian.</h1>

        </div>
    </div>

    <div class="card p-3">
        <form action="{{ route('teacher.create.post.ujian') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id_kelas" value="{{ $id_kelas }}" style="display: none;">
            <input type="hidden" name="id_guru" value="{{ $id_guru }}" style="display: none;">
            <div class="form-group mt-1">
                <label for="descriptionClass">Judul Ujian</label>
                <input type="text" class="form-control" id="descriptionClass" name="judul_ujian" placeholder="Masukan Ujian." />
                @error('judul_ujian') <small id="descriptionClass" class="form-text text-muted text-danger" style="color: #c54444 !important">{{ $message }}</small> @enderror
            </div>
            <div class="form-group mt-3">
                <label for="descriptionClass">Deskripsi Ujian</label>
                <textarea type="text" class="form-control" id="descriptionClass" name="deskripsi_ujian" placeholder="Masukan Ujian."></textarea>
                @error('deskripsi_ujian') <small id="descriptionClass" class="form-text text-muted text-danger" style="color: #c54444 !important">{{ $message }}</small> @enderror
            </div>
            <div class="form-group mt-2">
                <label for="formFile" class="form-label">Upload Ujian</label>
                <input class="form-control" type="file" id="formFile" name="file">

                @error('file') <small id="descriptionClass" class="form-text text-muted text-danger" style="color: #c54444 !important">{{ $message }}</small> @enderror
           </div>
            <input type="submit" class="btn btn-primary mt-3" value="Buat Ujian">
        </form>
    </div>

@endsection
