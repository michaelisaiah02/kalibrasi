<?php

namespace App\Models;

use App\Models\Equipment;
use Illuminate\Database\Eloquent\Model;

class MasterList extends Model
{
    protected $fillable = [
        'tipe_id',
        'no_id',
        'no_sn',
        'kapasitas',
        'ketelitian',
        'std_ukuran',
        'merk',
        'tgl_kalibrasi',
        'tipe_kalibrasi',
        'first_used',
        'rank',
        'freq_kalibrasi',
        'pic_pengguna',
        'location',
    ];

    public function equipment()
    {
        return $this->belongsTo(Equipment::class, 'tipe_id', 'tipe_id');
    }
}
