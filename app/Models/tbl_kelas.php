<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class tbl_kelas extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'tbl_kelas';
    protected $fillable = [
        'guru_id',
        'code_class',
        'name_class',
        'description_class',
        'class_schedule',
    ];
    protected $keyType = 'string';
    public $incrementing = false;

    // Relations
    public function guru() {
        return $this->belongsTo(User::class, 'guru_id')->withDefault();
    }

    public function materi(){
        return $this->hasMany(tbl_materi::class, 'kelas_id');
    }

    public function list_siswa(){
        return $this->hasMany(tbl_kelas_siswa::class, 'kelas_id');
    }

    public function ujian() {
        return $this->hasMany(tbl_ujian::class, 'kelas_id');
    }

    public function jawaban_ujian() {
        return $this->hasMany(tbl_jawaban_ujian::class, 'kelas_id');
    }

    public function tugas() {
        return $this->hasMany(tbl_tugas::class, 'id_kelas');
    }

    public function comment_materi() {
        return $this->hasMany(tbl_comment_materi::class, 'kelas_id');
    }

    public function comment_tugas() {
        return $this->hasMany(tbl_comment_tugas::class, 'kelas_id');
    }

}
