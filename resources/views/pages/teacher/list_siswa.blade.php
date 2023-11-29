@extends('layouts.default')
@section('content')

    <div class="position-relative">
        <a href="{{ route('teacher.detail.class', ['id' => $dataGuru->id]) }}" class="position-absolute btn btn-sm btn-primary">Kembali</a>
    </div>

   <div class="w-50 mt-4 m-auto">
       @include('partials.alert')

       <div class="list-teacher">
           <h3>Guru</h3>
           <hr>

           <div class="list-people d-flex flex-wrap justify-content-between">
               <div class="identity d-flex flex-wrap">
                   <img src="https://picsum.photos/200" class="rounded-circle me-3" width="40px" height="40px">
                    <h6 class="mt-2" style="font-weight: 600;color: #494949;">{{ $dataGuru->guru->guru->name }}</h6>
               </div>
           </div>
       </div>

       <div class="list-student mt-5">
           <div class="d-flex flex-wrap justify-content-between" style="margin-bottom: -15px">
               <h3>Siswa</h3>
               <p class="fw-bold me-2" style="font-size: 13px;margin-top: 15px;margin-bottom: -10px">{{ $countSiswa }} Siswa</p>
           </div>
           <hr>

           @forelse($listSiswa as $items)
               <div class="list-people d-flex flex-wrap justify-content-between mb-3">
                   <div class="identity d-flex flex-wrap">
                       <img src="https://picsum.photos/200" class="rounded-circle me-3" width="40px" height="40px">
                       <h6 class="mt-2" style="font-weight: 600;color: #494949;">{{ $items->siswa->siswa->name }}</h6>
                   </div>
                   <div class="action-siswa">
                       <form action="{{ route('teacher.delete.siswa', ['id' => $items->id]) }}" method="POST">
                           @csrf
                           @method('DELETE')
                           <button type="submit" class="btn btn-sm btn-danger">Remove</button>
                       </form>
{{--                       <a href="{{ route('teacher.delete.siswa', ['id' => $items->id]) }}" >remove</a>--}}
                   </div>
               </div>
           @empty
               <div class="p-2 rounded-1">
                   <p class="text-danger" style="margin-bottom: 0 !important;">Belum ada siswa yang bergabung</p>
               </div>
           @endforelse
       </div>
   </div>
@endsection
