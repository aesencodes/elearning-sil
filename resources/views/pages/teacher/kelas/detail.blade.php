@extends('layouts.default')
@section('content')

    <?php use Carbon\Carbon; ?>

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
                   <div class="border-1"><p>Kode Kelas : <b style="letter-spacing: 2px;background-color: white;color:black;border-radius:4px;padding:5px 10px;">{{ $datakelas->code_class }}</b> | Jadwal Kelas : {{ $datakelas->class_schedule }}</p></div>
               </div>

               {{-- Setting Class Button --}}
               <div class="dropdown">
                   <div class="pointer-event" id="dropdownMenuButton2" style="cursor: pointer;" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-cog"></i></div>
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
           <div class="m-2" style="width: 73%;">
                <div class="border-1 p-2 mb-2 d-flex flex-wrap justify-content-between">
                    <div style="width: 33.3%">
                        <a class="btn btn-primary me-2 d-block" href="{{ route('teacher.create.materi', ['id' => $datakelas->id, 'guru_id' => $datakelas->guru_id]) }}" class="small mb-4">Tambah Materi</a>
                    </div>
                    <div style="width: 33.3%">
                        <a class="btn btn-primary me-2 d-block" href="{{ route('teacher.create.tugas', ['id_kelas' => $datakelas->id, 'id_guru' => $datakelas->guru_id]) }}" class="small mb-4">Tambah Tugas</a>
                    </div>
                    <div style="width: 33.3%">
                        <a class="btn btn-primary me-2 d-block" href="{{ route('teacher.create.ujian', ['id_kelas' => $datakelas->id, 'id_guru' => $datakelas->guru_id]) }}" class="small mb-4">Tambah Ujian</a>
                    </div>
                </div>
               <hr class="mb-3 mt-3" />
               <nav>
                   <div class="nav nav-tabs" id="nav-tab" role="tablist">
                       <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-materi" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Daftar Materi</button>
                       <button class="nav-link" id="nav-disabled-tab" data-bs-toggle="tab" data-bs-target="#nav-tugas" type="button" role="tab" aria-controls="nav-disabled" aria-selected="true">Daftar Tugas</button>
                       <button class="nav-link" id="nav-disabled-tab" data-bs-toggle="tab" data-bs-target="#nav-ujian" type="button" role="tab" aria-controls="nav-disabled" aria-selected="true">Daftar Ujian</button>
                   </div>
               </nav>
               <div class="tab-content" id="nav-tabContent">
                   {{-- Daftar Materi --}}
                   <div class="tab-pane fade show active" id="nav-materi" role="tabpanel" aria-labelledby="nav-materi-tab" tabindex="0">
                       @forelse ($datamateri as $item)
                           <div class="card p-3 mb-2 mt-2">
                               <div class="d-flex flex-wrap justify-content-between">
                                   <h3 class="mb-3">{{ $item->title_materi }}</h3>

                                   {{-- Setting Materi --}}
                                   <div class="dropdown">
                                       <div class="pointer-event" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;"><i class="fas fa-cog"></i></div>
                                       <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2">
                                           <li><a class="dropdown-item" href="{{ route('teacher.update.materi', ['id' => $item->id]) }}">Perbarui Materi</a></li>
                                           <li>
                                               <form action="{{ route('teacher.delete.materi', $item->id) }}" method="POST">
                                                   @csrf
                                                   @method('DELETE')
                                                   <button type="submit" class="btn btn-danger btn-sm w-100">Delete Materi</button>
                                               </form>
                                           </li>
                                       </ul>
                                   </div>
                               </div>

                               <h6 class="casrd-subtitle mb-2 text-justify">{{ $item->description_materi }}</h6>
                               @if($item->file_name_materi != null)
                                   <a class="mt-3" href="{{ route('teacher.download.materi', ['file_name' => $item->file_name_materi, 'id_guru' => $datakelas->guru_id, 'id_kelas' => $datakelas->id]) }}">Download Berkas Materi</a>
                               @endif

                               <hr class="mt-2 mb-3">

                               <div class="comment p-4">
                                   <h4 class="mb-3">Komentar.</h4>

                                   @forelse($item->comment_materi as $itemComment)
                                       <div class="d-flex flex-wrap justify-content-between">
                                           <div>
                                               <img src="https://picsum.photos/200/300" width="50px" height="50px" class="rounded-circle">
                                           </div>
                                           <div style="width: 92%">
                                               <h5 class="mb-2">
                                                   @if($itemComment->user->role_id ==  "199300")
                                                        {{ $itemComment->user->guru->name }}
                                                   @else
                                                       {{ $itemComment->user->siswa->name }}
                                                   @endif
                                               </h5>
                                               <p>{{ $itemComment->comment }}</p>
                                           </div>
                                       </div>
                                   @empty
                                        <div class="p-2 border-danger bg-danger rounded-1">
                                            <p class="text-white" style="margin-bottom: 0 !important;">Belum Ada Komentar</p>
                                        </div>
                                   @endforelse
                                   <form action="{{ route('send.comment.materi') }}" class="mt-2 mb-2" method="post">
                                       @csrf
                                       <input type="hidden" name="kelas_id" value="{{ $datakelas->id}}">
                                       <input type="hidden" name="user_id" value="{{ Auth::user()->id}}">
                                       <input type="hidden" name="materi_id" value="{{ $item->id}}">
                                        <div class="d-flex flex-wrap">
                                            <input type="text" name="comment_materi" class="form-control me-2" placeholder="Masukan Komentar" style="width: 91.7%">
                                            <input type="submit" value="Kirim" class="btn btn-primary">
                                        </div>
                                   </form>
                               </div>
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
                               <div class="d-flex flex-wrap justify-content-between">
                                   <div class="title-tugas">
                                       <h3 class="mb-3">{{ $item->judul_tugas }}</h3>
                                       <p style="font-size: 14px;margin-top: -5px;">Batas Pengumpulan Tugas : {{ Carbon::parse($item->deadline)->format('j F Y, g:i A') }}</p>
                                   </div>

                                   {{-- Setting Tugas --}}
                                   <div class="dropdown">
                                       <div class="pointer-event" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;"><i class="fas fa-cog"></i></div>
                                       <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2">
                                           <li><a class="dropdown-item" href="{{ route('teacher.update.tugas', ['id' => $item->id]) }}">Perbarui Tugas</a></li>
                                           <li>
                                               <form action="{{ route('teacher.delete.tugas', $item->id) }}" method="POST">
                                                   @csrf
                                                   @method('DELETE')
                                                   <button type="submit" class="btn btn-danger btn-sm w-100">Delete Tugas</button>
                                               </form>
                                           </li>
                                       </ul>
                                   </div>
                               </div>
                               <p class="card-subtitle mb-2 mt-2 text-justify">{{ $item->deskripsi_tugas }}</p>
                               @if($item->file_upload_tugas != null)
                                   <a class="mt-3" href="{{ route('teacher.download.tugas', ['file_name' => $item->file_upload_tugas, 'id_guru' => $datakelas->guru_id, 'id_kelas' => $datakelas->id]) }}">Download Berkas Tugas</a>
                               @endif

                               <hr class="mt-2 mb-3">

                               <div class="comment p-2 ">
                                   <h4 class="mb-3">Komentar.</h4>

                                   @forelse($item->comment_tugas as $itemComment)
                                       <div class="d-flex flex-wrap justify-content-between">
                                           <div>
                                               <img src="https://picsum.photos/200/300" width="50px" height="50px" class="rounded-circle">
                                           </div>
                                           <div style="width: 92%">
                                               <h5 class="mb-2">
                                                   @if($itemComment->user->role_id ==  "199300")
                                                       {{ $itemComment->user->guru->name }}
                                                   @else
                                                       {{ $itemComment->user->siswa->name }}
                                                   @endif
                                               </h5>
                                               <p>{{ $itemComment->comment }}</p>
                                           </div>
                                       </div>
                                   @empty
                                       <div class="p-2 border-danger bg-danger rounded-1">
                                           <p class="text-white" style="margin-bottom: 0 !important;">Belum Ada Komentar</p>
                                       </div>
                                   @endforelse
                                   <form action="{{ route('send.comment.tugas') }}" class="mt-2 mb-2" method="post">
                                       @csrf
                                       <input type="hidden" name="kelas_id" value="{{ $datakelas->id}}">
                                       <input type="hidden" name="user_id" value="{{ Auth::user()->id}}">
                                       <input type="hidden" name="tugas_id" value="{{ $item->id}}">
                                       <div class="d-flex flex-wrap">
                                           <input type="text" name="comment_materi" class="form-control me-2" placeholder="Masukan Komentar" style="width: 91.7%">
                                           <input type="submit" value="Kirim" class="btn btn-primary">
                                       </div>
                                   </form>
                               </div>

                           </div>
                       @empty
                           <div class="card mb-2 mt-4 bg-danger">
                               <p class="text-white text-center align-content-center pt-2">Belum Ada Tugas</p>
                           </div>
                       @endforelse
                   </div>

                    {{-- Daftar Ujian --}}
                   <div class="tab-pane fade" id="nav-ujian" role="tabpanel" aria-labelledby="nav-ujian-tab" tabindex="0">
                       @forelse ($dataUjian as $item)
                           <div class="card p-3 mb-2 mt-2">
                               <div class="d-flex flex-wrap justify-content-between">
                                   <div>
                                       <h3 class="mb-3">{{ $item->judul_ujian }}</h3>
                                       <p style="font-size: 14px;margin-top: -5px;">Batas Waktu Ujian : {{ Carbon::parse($item->deadline)->format('j F Y, g:i A') }}</p>
                                   </div>

                                   {{-- Setting Ujian --}}
                                   <div class="dropdown">
                                       <div class="pointer-event" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;"><i class="fas fa-cog"></i></div>
                                       <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2">
                                           <li><a class="dropdown-item" href="{{ route('teacher.update.ujian', ['id' => $item->id]) }}">Perbarui Ujian</a></li>
                                           <li>
                                               <form action="{{ route('teacher.delete.ujian', $item->id) }}" method="POST">
                                                   @csrf
                                                   @method('DELETE')
                                                   <button type="submit" class="btn btn-danger btn-sm w-100">Delete Tugas</button>
                                               </form>
                                           </li>
                                       </ul>
                                   </div>
                               </div>

                               <h6 class="casrd-subtitle mb-2 text-justify">{{ $item->description }}</h6>

                               @if($item->nama_file_ujian != null)
                                   <a class="mt-3" href="{{ route('student.download.ujian', ['file_name' => $item->nama_file_ujian, 'id_guru' => $datakelas->guru_id, 'id_kelas' => $datakelas->id]) }}">Download Berkas Materi</a>
                               @endif
                           </div>
                       @empty
                           <div class="card mb-2 mt-4 bg-danger">
                               <p class="text-white text-center align-content-center pt-2">Belum Ada Ujian</p>
                           </div>
                       @endforelse
                   </div>
               </div>
           </div>
       </div>
   </div>

@endsection
