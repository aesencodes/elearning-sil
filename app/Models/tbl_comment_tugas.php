<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class tbl_comment_tugas extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'tbl_comment_tugas';
    protected $fillable = [
        'user_id',
        'tugas_id',
        'kelas_id',
        'comment',
    ];
    protected $keyType = 'string';
    public $incrementing = false;

    // Relations
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tugas_id() {
        return $this->belongsTo(tbl_tugas::class, 'materi_id');
    }

    public function kelas_id() {
        return $this->belongsTo(tbl_kelas::class, 'kelas_id');
    }

}
