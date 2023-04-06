<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahunAjaran extends Model
{
    use HasFactory;

    public $table = 'tahun_ajaran';

    public $fillable = [
        'tahun_ajaran', 'semester', 'status'
    ];

    public function kelas()
    {
        return $this->hasMany(Kelas::class, 'tahun_ajaran_id', 'id');
    }
}
