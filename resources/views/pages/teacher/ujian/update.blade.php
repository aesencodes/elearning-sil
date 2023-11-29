@extends('layouts.default')
@section('content')

    @include('partials.alert')

    <div class="d-flex flex-wrap justify-content-between">
        <div class="mb-4">
            <h1 class="mt-4 ms-2">Perbarui Ujian.</h1>
        </div>
    </div>

    <div class="card p-3">
        <form action="{{ route('teacher.update.ujian.post') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id_kelas" value="{{ $dataUjian->kelas_id }}" style="display: none;">
            <input type="hidden" name="id_guru" value="{{ $dataUjian->guru_id }}" style="display: none;">
            <input type="hidden" name="id_ujian" value="{{ $dataUjian->id }}" style="display: none;">
            <input type="hidden" name="old_file" value="{{ $dataUjian->nama_file_ujian }}" style="display: none;">
            <div class="form-group mt-1">
                <label for="descriptionClass">Judul Ujian</label>
                <input type="text" class="form-control" id="descriptionClass" name="judul_ujian" value="{{ $dataUjian->judul_ujian }}" placeholder="Masukan Tugas." />
                @error('judul_tugas') <small id="descriptionClass" class="form-text text-muted text-danger" style="color: #c54444 !important">{{ $message }}</small> @enderror
            </div>
            <div class="form-group mt-3">
                <label for="description">Deskripsi Ujian</label>
                <textarea type="text" class="form-control" id="description" name="description" placeholder="Masukan Tugas.">{{ $dataUjian->description }}</textarea>
                @error('description') <small id="descriptionClass" class="form-text text-muted text-danger" style="color: #c54444 !important">{{ $message }}</small> @enderror
            </div>
            <div class="form-group mt-1">
                <label for="deadline">Batas Waktu Tugas</label>
                <input type="datetime-local" class="form-control" id="deadline" name="deadline" value="{{ $dataUjian->deadline }}" placeholder="Batas Waktu Tugas." min="2020-01-01T00:00"/>
                @error('deadline') <small id="deadline" class="form-text text-muted text-danger" style="color: #c54444 !important">{{ $message }}</small> @enderror
            </div>
            <div class="form-group card p-3 mt-3">
                <label for="formFile" class="form-label fw-bold">Upload Tugas</label>

                @if($dataUjian->nama_file_ujian != null)
                    <p style="margin-bottom: -5px">File Tugas Lama</p>
                    <a class="d-block mb-3" href="{{ route('student.download.ujian', ['file_name' => $dataUjian->nama_file_ujian, 'id_guru' => $dataUjian->guru_id, 'id_kelas' => $dataUjian->kelas_id]) }}">{{ $dataUjian->nama_file_ujian }}</a>
                @endif

                <input class="form-control" type="file" id="formFile" name="file">
                @error('file') <small id="descriptionClass" class="form-text text-muted text-danger" style="color: #c54444 !important">{{ $message }}</small> @enderror
            </div>
            <input type="submit" class="btn btn-primary mt-3" value="Perbarui Ujian">
        </form>
    </div>

@endsection
