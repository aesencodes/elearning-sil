<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class tbl_materi extends Model
{
    use HasFactory, HasUuids;

    protected $table = "tbl_materis";
    protected $fillable = [
        'guru_id',
        'kelas_id',
        'title_materi',
        'file_name_materi',
        'description_materi'
    ];
    protected $keyType = 'string';
    public $incrementing = false;

    // Relations Table
    public function kelas() {
        return $this->belongsTo(tbl_kelas::class, 'kelas_id');
    }

    public function guru() {
        return $this->belongsTo(User::class, 'guru_id');
    }

    public function comment_materi() {
        return $this->hasMany(tbl_comment_materi::class, 'materi_id');
    }
}
