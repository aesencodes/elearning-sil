<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class set_library extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'set_libraries';
    public $timestamps = true;

}
