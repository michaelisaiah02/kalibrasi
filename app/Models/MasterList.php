<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterList extends Model
{
    protected $fillable = [
        'type_id',
        'id_num',
        'sn_num',
        'capacity',
        'accuracy',
        'unit_id',
        'brand',
        'calibration_type',
        'first_used',
        'rank',
        'calibration_freq',
        'acceptance_criteria',
        'pic',
        'location',
    ];

    protected $casts = [
        'first_used' => 'date',
    ];

    public function equipment()
    {
        return $this->belongsTo(Equipment::class, 'type_id', 'type_id');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    public function standard()
    {
        return $this->hasOne(Standard::class, 'id_num', 'id_num');
    }

    public function results()
    {
        return $this->hasMany(Result::class, 'id_num', 'id_num');
    }

    public function repairs()
    {
        return $this->hasMany(Repair::class, 'id_num', 'id_num');
    }

    public function latestResult()
    {
        return $this->hasOne(Result::class, 'id_num', 'id_num')->latestOfMany('calibration_date');
    }
}
