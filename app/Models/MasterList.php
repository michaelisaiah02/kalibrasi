<?php

namespace App\Models;

use App\Models\Equipment;
use Illuminate\Database\Eloquent\Model;

class MasterList extends Model
{
    protected $fillable = [
        'type_id',
        'id_num',
        'sn_num',
        'capacity',
        'accuracy',
        'unit',
        'merk',
        'calibration_type',
        'first_used',
        'rank',
        'calibration_freq',
        'acceptance_criteria',
        'pic',
        'location',
    ];

    public function equipment()
    {
        return $this->belongsTo(Equipment::class, 'type_id', 'type_id');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }
}
