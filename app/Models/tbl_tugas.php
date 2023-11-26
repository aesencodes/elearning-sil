<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class tbl_tugas extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'tbl_tugas';
    protected $fillable =[
        'id',
        'id_guru',
        'judul_tugas',
        'deskripsi_tugas',
        'file_upload_tugas',
        'id_kelas'
    ];
    protected $keyType = 'string';
    public $incrementing = false;

    // Relations
    public function guru() {
        return $this->belongsTo(User::class, 'id_guru');
    }

    public function kelas() {
        return $this->belongsTo(tbl_kelas::class, 'id_kelas');
    }

    public function comment_tugas() {
        return $this->hasMany(tbl_comment_tugas::class, 'tugas_id');
    }
}
