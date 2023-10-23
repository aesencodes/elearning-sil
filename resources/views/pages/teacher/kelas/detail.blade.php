@extends('layouts.default')
@section('content')

    @include('partials\alert')

    @section('style')
        <style>
            .text-below {
                position: absolute;
                bottom: 0;
                left: 0;
                width: 100%;
            }
        </style>
    @endsection

   <div class="container mb-4 mt-4">
       {{-- Banner kelas --}}
       <div class="banner p-4 rounded-4 position-relative"
            style="background-image: url('https://www.gstatic.com/classroom/themes/img_reachout.jpg');height: 300px;background-size: cover;">
           <div class="d-flex flex-wrap justify-content-end">
               <div class="text-below p-4 text-white">
                   <h1 class="text-capitalize">{{ $datakelas->name_class }}</h1>
                   <p>{{ $datakelas->description_class }}</p>
               </div>

               {{-- Setting Class Button --}}
               <div class="dropdown">
                   <div class="pointer-event" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-cog"></i></div>
                   <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2">
                       <li><a class="dropdown-item" href="{{ route('teacher.update.class', ['id' => $datakelas->id]) }}">Perbarui Kelas</a></li>
                       <li>
                           <form action="{{ route('teacher.delete.class', $datakelas->id) }}" method="POST">
                               @csrf
                               @method('DELETE')
                               <button type="submit" class="btn btn-danger btn-sm w-100">Delete Kelas</button>
                           </form>
                       </li>
                   </ul>
               </div>
           </div>
       </div>

       {{-- Daftar tugas / ujian / materi  --}}
       <div class="d-flex flex-wrap justify-content-between mt-3">
            <div class="m-2" style="width: 22% !important;">
                <div class="card p-3">
                    <h4>Daftar Tugas</h4>
                    <ul>
                        <li>Tugas Pertama</li>
                        <li>Tugas kedua</li>
                        <li>Tugas ketiga</li>
                    </ul>
                </div>
            </div>
           <div class="w-75 m-2">
               <div class="card p-2">
                   <h3>Tugas Pertama</h3>
               </div>
           </div>
       </div>
   </div>

@endsection
