<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Concerns\HasUuids;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected $keyType = 'string';
    public $incrementing = false;


    // Relations

    public function siswa() {
        return $this->hasOne(tbl_siswa::class, 'user_id');
    }
    public function guru() {
        return $this->hasOne(tbl_guru::class, 'user_id');
    }

    public function kelas(){
        return $this->hasMany(tbl_kelas::class, 'guru_id');
    }

    public function materi(){
        return $this->hasMany(tbl_materi::class, 'materi_id');
    }

    public function comment_materi() {
        return $this->hasMany(tbl_comment_materi::class, 'user_id');
    }
}
