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
    ];
    protected $keyType = 'string';
    public $incrementing = false;

    // Relations
    public function guru_id() {
        return $this->belongsTo(User::class, 'guru_id')->withDefault();
    }
}
