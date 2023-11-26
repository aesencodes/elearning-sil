<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_jawaban_tugas extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'tbl_jawaban_tugas';
    protected $fillable = [
        'id_tugas',
        'id_siswa',
        'file_upload_jawab',
        'nilai',
        'keterangan',
    ];

    protected $keyType = 'string';
    public $incrementing = false;

    // Relations

    public function kelas() {
        return $this->belongsTo(tbl_kelas::class, 'kelas_id');
    }

    public function tugas() {
        return $this->belongsTo(tbl_tugas::class, 'tugas_id');
    }
}
