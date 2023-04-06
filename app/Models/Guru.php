<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;

    public $table = 'guru';
    protected $primaryKey = 'nip';
    public $incrementing = false;
    protected $keyType = 'string';

    public $fillable = [
        'nip', 'user_id', 'jenis_kelamin', 'pangkat', 'golongan', 'jabatan'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function kelas()
    {
        return $this->hasMany(Kelas::class, 'wali_kelas', 'nip');
    }

    public function mapel()
    {
        return $this->hasMany(MataPelajaran::class, 'guru', 'nip');
    }
}
