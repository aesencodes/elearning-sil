<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_siswa extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'tbl_siswas';
    protected $fillable = [
        'user_id',
        'nis',
        'nisn',
        'name',
        'gander_id',
        'tempat_lahir',
        'tanggal_lahir',
        'nama_orang_tua',
        'nama_wali',
        'no_hp_siswa',
        'no_hp_orang_tua',
        'no_hp_wali',
        'jurusan_id',
        'tingkat_id',
        'kelas_id',
        'status_id',
    ];

    protected $keyType = 'string';
    public $incrementing = false;

    // Relations

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
