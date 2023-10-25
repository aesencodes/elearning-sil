<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class tbl_comment_materi extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'tbl_comment_materis';
    protected $fillable = [
        'user_id',
        'materi_id',
        'comment',
    ];
    protected $keyType = 'string';
    public $incrementing = false;

    // Relations

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function materi() {
        return $this->belongsTo(tbl_materi::class, 'materi_id');
    }
}
