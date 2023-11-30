<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_jawaban_ujian extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'tbl_jawaban_ujians';
    protected $fillable = [
        'kelas_id',
        'ujian_id',
        'siswa_id',
        'nilai',
        'keterangan',
        'nama_file_jawaban_ujian',
    ];
    protected $keyType = 'string';
    public $incrementing = false;

    // relations

    public function kelas() {
        return $this->belongsTo(tbl_kelas::class, 'kelas_id');
    }

    public function ujian() {
        return $this->belongsTo(tbl_ujian::class, 'ujian_id');
    }

    public function siswa() {
        return $this->belongsTo(User::class, 'siswa_id');
    }

}
