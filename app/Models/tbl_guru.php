<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class tbl_guru extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'tbl_gurus';
    protected $fillable = [
        'nuptk',
        'name',
        'user_id',
        'gander_id',
        'nomor_hp',
    ];

    protected $keyType = 'string';
    public $incrementing = false;

    //  Relations
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

}
