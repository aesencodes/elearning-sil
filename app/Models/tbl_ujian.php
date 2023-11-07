<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_ujian extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'tbl_ujians';
    protected $fillable = [
        'kelas_id',
        'guru_id',
        'judul_ujian',
        'description',
        'name_file_ujian',
    ];
    protected $keyType = 'string';
    public $incrementing = false;

    // Realtions

    public function kelas() {
        return $this->belongsTo(tbl_kelas::class, 'kelas_id');
    }

    public function guru() {
        return $this->belongsTo(User::class, 'guru_id');
    }

    public function jawaban_ujian() {
        return $this->hasMany(tbl_jawaban_ujian::class, 'ujian_id');
    }
}
