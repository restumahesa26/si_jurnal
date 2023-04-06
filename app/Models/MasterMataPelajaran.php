<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterMataPelajaran extends Model
{
    use HasFactory;

    public $table = 'master_mata_pelajaran';

    public $fillable = [
        'nama_mata_pelajaran', 'jenis_mata_pelajaran'
    ];

    public function mapel()
    {
        return $this->hasMany(MataPelajaran::class, 'mata_pelajaran_id', 'id');
    }
}
