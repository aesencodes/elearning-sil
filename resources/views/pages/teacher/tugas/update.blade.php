@extends('layouts.default')
@section('content')

    @include('partials\alert')

    <div class="d-flex flex-wrap justify-content-between">
        <div>
            <h1 class="mt-4 ms-2">Perbarui Data Tugas.</h1>
            <ol class="breadcrumb mb-4 ms-2">
                <li class="breadcrumb-item active">Perbarui kelas Untuk siswamu.</li>
            </ol>
        </div>
    </div>

    <div class="card p-3">
        <form action="{{ route('teacher.update.tugas.post') }}" method="post" >
            @csrf
            <input type="hidden" name="id_tugas" value="{{ $dataTugas->id }}" style="display: none;">
            <input type="hidden" name="id_kelas" value="{{ $dataTugas->id_kelas }}" style="display: none;">
            <input type="hidden" name="id_guru" value="{{ $dataTugas->id_guru }}" style="display: none;">
            <input type="hidden" name="old_file" value="{{ $dataTugas->file_upload_tugas }}" style="display: none;">
            <div class="form-group mt-1">
                <label for="descriptionClass">Judul Tugas</label>
                <input type="text" class="form-control" id="descriptionClass" name="judul_tugas" value="{{ $dataTugas->judul_tugas }}" placeholder="Masukan Tugas."/>
                @error('judul_tugas') <small id="descriptionClass" class="form-text text-muted text-danger" style="color: #c54444 !important">{{ $message }}</small> @enderror
            </div>
            <div class="form-group mt-3">
                <label for="descriptionClass">Deskripsi Tugas</label>
                <textarea type="text" class="form-control" id="descriptionClass" name="deskripsi_tugas" placeholder="Masukan Tugas.">{{ $dataTugas->deskripsi_tugas }}</textarea>
                @error('deskripsi_tugas') <small id="descriptionClass" class="form-text text-muted text-danger" style="color: #c54444 !important">{{ $message }}</small> @enderror
            </div>
            <div class="form-group mt-3">
                <label for="deadline">Batas Waktu Tugas</label>
                <input type="datetime-local" class="form-control" id="deadline" name="deadline" value="{{ $dataTugas->deadline }}" placeholder="Batas Waktu Tugas." min="2020-01-01T00:00"/>
                @error('deadline') <small id="deadline" class="form-text text-muted text-danger" style="color: #c54444 !important">{{ $message }}</small> @enderror
            </div>
            <div class="form-group card p-3 mt-3">
                <label for="formFile" class="form-label fw-bold">Upload Tugas</label>

                @if($dataTugas->file_upload_tugas != null)
                    <p style="margin-bottom: -5px">File Tugas Lama</p>
                    <a class="d-block mb-3" href="{{ route('teacher.download.tugas', ['file_name' => $dataTugas->file_upload_tugas, 'id_guru' => $dataTugas->id_guru, 'id_kelas' => $dataTugas->id_kelas]) }}">{{ $dataTugas->file_upload_tugas }}</a>
                @endif

                <input class="form-control" type="file" id="formFile" name="file">
                @error('file') <small id="descriptionClass" class="form-text text-muted text-danger" style="color: #c54444 !important">{{ $message }}</small> @enderror
            </div>
            <input type="submit" class="btn btn-primary mt-3" value="Update Tugas">
        </form>
    </div>

@endsection
