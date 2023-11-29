@extends('layouts.default')
@section('content')

    @include('partials.alert')

    <div class="d-flex flex-wrap justify-content-between">
        <div>
            <h1 class="mt-4 ms-2">Buat Kelas.</h1>
            <ol class="breadcrumb mb-4 ms-2">
                <li class="breadcrumb-item active">Buat kelas Untuk siswamu.</li>
            </ol>
        </div>
    </div>

    <div class="card p-3">
        <form action="{{ route('teacher.create.post.class') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="nameClass">Nama Kelas</label>
                <input type="text" class="form-control" id="nameClass" name="name_class" placeholder="Masukan nama kelas kamu.">
                @error('name_class') <small id="nameClass" class="form-text text-muted text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="form-group mt-3">
                <label for="descriptionClass">Deskripsi Kelas</label>
                <textarea type="text" class="form-control" id="descriptionClass" name="description_class" placeholder="Masukan deskripsi kelas kamu."></textarea>
                @error('name_class') <small id="descriptionClass" class="form-text text-muted text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="form-group mt-3">
                <label for="deadline">Jadwal Kelas</label><br>

                <div class="d-flex flex-wrap">
                    <select id="hari" name="hari" class="form-select me-3" style="width: 10%">
                        <option value="senin">Senin</option>
                        <option value="selasa">Selasa</option>
                        <option value="rabu">Rabu</option>
                        <option value="kamis">Kamis</option>
                        <option value="jumat">Jumat</option>
                        <option value="sabtu">Sabtu</option>
                    </select>
                    <input type="time" class="form-control w-25" id="waktu" name="waktu" value="07.00" min="06:00" max="20:00">
                </div>
                @error('class_schedule') <small id="deadline" class="form-text text-muted text-danger" style="color: #c54444 !important">{{ $message }}</small> @enderror
            </div>
            <input type="submit" class="btn btn-primary mt-3" value="Buat Kelas">
        </form>
    </div>

@endsection
