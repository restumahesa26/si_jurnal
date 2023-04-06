<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WakaKurikulum extends Model
{
    use HasFactory;

    public $table = 'waka_kurikulum';
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
}
