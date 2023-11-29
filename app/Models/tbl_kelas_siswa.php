<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
class tbl_kelas_siswa extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'tbl_kelas_siswas';
    protected $fillable = [
        'kelas_id',
        'siswa_id',
    ];
    protected $keyType = 'string';
    public $incrementing = false;

    // Realtions

    public function kelas() {
        return $this->belongsTo(tbl_kelas::class, 'kelas_id');
    }

    public function siswa() {
        return $this->belongsTo(User::class, 'siswa_id');
    }
}
