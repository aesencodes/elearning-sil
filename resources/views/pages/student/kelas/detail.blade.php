@extends('layouts.default')
@section('content')

    @include('partials.alert')

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
           </div>
       </div>

       {{-- Daftar tugas / ujian / materi  --}}
       <div class="d-flex flex-wrap justify-content-between mt-3">
            <div class="m-2" style="width: 22% !important;">
                <div class="card p-3">
                    <h4>Daftar Tugas</h4>
                    <ul>
                    </ul>
                </div>
            </div>
           <div class="m-2" style="width: 73%;">
               <nav>
                   <div class="nav nav-tabs" id="nav-tab" role="tablist">
                       <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-materi" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Daftar Materi</button>
                       <button class="nav-link" id="nav-disabled-tab" data-bs-toggle="tab" data-bs-target="#nav-tugas" type="button" role="tab" aria-controls="nav-disabled" aria-selected="true">Daftar Tugas</button>
                   </div>
               </nav>
               <div class="tab-content" id="nav-tabContent">
                   {{-- Daftar Materi --}}
                   <div class="tab-pane fade show active" id="nav-materi" role="tabpanel" aria-labelledby="nav-materi-tab" tabindex="0">
                       @forelse ($datamateri as $item)
                           <div class="card p-2 mb-2 mt-2">
                               <h3 class="mb-3">{{ $item->title_materi }}</h3>
                               <h6 class="casrd-subtitle mb-2 text-justify">{{ $item->description_materi }}</h6>
                           </div>
                       @empty
                           <div class="card mb-2 mt-4 bg-danger">
                               <p class="text-white text-center align-content-center pt-2">Belum Ada Materi</p>
                           </div>
                       @endforelse
                   </div>

                   {{-- Daftar Tugas --}}
                   <div class="tab-pane fade" id="nav-tugas" role="tabpanel" aria-labelledby="nav-tugas-tab" tabindex="0">
                       @forelse($dataTugas as $item)
                           <div class="card p-3 mb-2 mt-2">
                               <h3 class="mb-3">{{ $item->judul_tugas }}</h3>
                               <p class="card-subtitle mb-2 mt-2 text-justify">{{ $item->deskripsi_tugas }}</p>
                               @if($item->file_upload_tugas != null)
                                   <a class="mt-3" href="{{ route('teacher.download.tugas', ['file_name' => $item->file_upload_tugas, 'id_guru' => $datakelas->guru_id, 'id_kelas' => $datakelas->id]) }}">Download Berkas Tugas</a>
                               @endif
                           </div>
                       @empty
                           <div class="card mb-2 mt-4 bg-danger">
                               <p class="text-white text-center align-content-center pt-2">Belum Ada Tugas</p>
                           </div>
                       @endforelse
                   </div>
               </div>
           </div>
       </div>
   </div>

@endsection
