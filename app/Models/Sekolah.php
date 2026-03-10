<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Yayasan;

class Sekolah extends Model
{
    protected $fillable = [
        'nama_sekolah',
        'yayasan_id',
        'alamat',
        'telepon',
    ];

    public function yayasan()
    {
        return $this->belongsTo(Yayasan::class);
    }
}
