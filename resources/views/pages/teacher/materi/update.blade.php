@extends('layouts.default')
@section('content')

    @include('partials.alert')

    <div class="d-flex flex-wrap justify-content-between">
        <div>
            <h1 class="mt-4 ms-2">Perbarui Materi</h1>
        </div>
    </div>

    <div class="card p-3">
        <form action="{{ route('teacher.update.materi.post') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="nameClass">Nama Materi</label>
                <input type="text" class="form-control" id="nameClass" name="name" value="{{ $dataMateri->title_materi }}" placeholder="Masukan judul materi">
                @error('name') <small id="nameClass" class="form-text text-muted text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="form-group mt-3">
                <label for="descriptionClass">Deskripsi Materi</label>
                <textarea type="text" class="form-control" id="descriptionClass" name="desc" placeholder="">{{ $dataMateri->description_materi }}</textarea>
                @error('desc') <small id="descriptionClass" class="form-text text-muted text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="form-group card p-3 mt-3">
                <label for="formFile" class="form-label fw-bold">Upload Materi</label>

                @if($dataMateri->file_name_materi != null)
                    <p style="margin-bottom: -5px">File Materi Lama</p>
                    <a class="d-block mb-3" href="{{ route('teacher.download.materi', ['file_name' => $dataMateri->file_name_materi, 'id_guru' => $dataMateri->guru_id, 'id_kelas' => $dataMateri->kelas_id]) }}">{{ $dataMateri->file_name_materi }}</a>
                @endif

                <input class="form-control" type="file" id="formFile" name="file">
                @error('file') <small id="descriptionClass" class="form-text text-muted text-danger" style="color: #c54444 !important">{{ $message }}</small> @enderror
            </div>

            <input type="hidden" name="id_materi" value="{{ $dataMateri->id }}">
            <input type="hidden" name="id_guru" value="{{ $dataMateri->guru_id }}">
            <input type="hidden" name="id_kelas" value="{{ $dataMateri->kelas_id }}">
            <input type="hidden" name="old_file" value="{{ $dataMateri->file_name_materi }}">

            <input type="submit" class="btn btn-primary mt-3" value="Perbarui Materi">
        </form>
    </div>
@endsection
