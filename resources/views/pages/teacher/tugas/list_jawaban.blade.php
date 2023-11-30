@extends('layouts.default')
@section('content')

    <div class="position-relative">
        <a href="{{ route('teacher.detail.class', ['id' => $id_kelas]) }}" class="position-absolute btn btn-sm btn-primary">Kembali</a>
    </div>

   <div class="w-50 mt-4 m-auto">
       @include('partials.alert')

       <div class="list-student mt-5">
           <div class="d-flex flex-wrap justify-content-between" style="margin-bottom: -15px">
               <h3>Daftar Jawaban</h3>
               <p class="fw-bold me-2" style="font-size: 13px;margin-top: 15px;margin-bottom: -10px">{{ $countJawaban }} Jawaban</p>
           </div>
           <hr>

           @forelse($listJawaban as $items)
               <div class="list-people border rounded-1 p-2 d-flex flex-wrap justify-content-between mb-3" style="margin-bottom: -10px">
                   <div class="identity d-flex flex-wrap">
                       <img src="https://picsum.photos/200" class="rounded-circle me-3" width="40px" height="40px">
                       <div class="mt-2">
                           <h6 class="" style="font-weight: 600;color: #494949;">{{ $items->siswa->siswa->name }}</h6>
                       </div>

                       <div>
                           <a class="d-block mb-3 btn btn-sm btn-primary ms-3 mt-1" style="margin-bottom: 6px !important;"
                              href="{{ route('student.download.jawaban.tugas', ['id_jawaban' => $items->id]) }}">
                               Download Berkas Jawaban
                           </a>
                       </div>

                       <p class="fw-bold ms-3 mt-2" style="letter-spacing: 0.4px;margin-bottom: -5px;font-size: 14px;">
                           Nilai : @if($items->nilai != null) {{ $items->nilai }} @else <span class="text-danger">Belum ada Nilai</span> @endif
                       </p>
                   </div>
                   <div class="action-siswa">
                       <form action="{{ route('teacher.nilai.tugas.post') }}" class="d-flex flex-wrap justify-content-end" method="post">
                           @csrf
                           <input type="hidden" name="id_kelas" value="{{ $items->id_kelas }}" style="display: none;">
                           <input type="hidden" name="id_tugas" value="{{ $items->id_tugas }}" style="display: none;">
                           <input type="hidden" name="id_siswa" value="{{ $items->id_siswa }}" style="display: none;">

                           <input type="text" name="nilai" style="width: 45%;" value="{{ $items->nilai }}" placeholder="Berikan Nilai" class="form-control me-2">
                           <input type="submit" class="btn btn-sm btn-primary" value="Kirim">
                       </form>
                   </div>
               </div>
           @empty
               <div class="p-2 rounded-1">
                   <p class="text-danger" style="margin-bottom: 0 !important;">Belum ada siswa yang memberikan jawaban</p>
               </div>
           @endforelse
       </div>
   </div>
@endsection
