<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterList extends Model
{
    protected $fillable = [
        'no_id',
        'alat_ukur_id',
        'no_sn',
        'kapasitas',
        'ketelitian',
        'std_ukuran',
        'merk',
        'tgl_kalibrasi',
        'tipe_kalibrasi',
        'rank',
        'freq_kalibrasi',
        'pic_pengguna',
        'location',
    ];

    public function alatUkur()
    {
        return $this->belongsTo(AlatUkur::class, 'tipe_id', 'tipe_id');
    }
}
