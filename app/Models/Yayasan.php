<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Sekolah;

class Yayasan extends Model
{
    protected $fillable = [
        'nama_yayasan',
        'alamat',
        'telepon',
    ];

    public function sekolah()
    {
        return $this->hasMany(Sekolah::class);
    }
}
