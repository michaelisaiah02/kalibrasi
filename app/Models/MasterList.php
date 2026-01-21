<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
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

    protected function status(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->calculateStatus(),
        );
    }

    private function calculateStatus()
    {
        $latestResult = $this->latestResult;

        if (! $latestResult) {
            return 'NEW';
        }

        $previousResult = $this->results()
            ->where('id', '!=', $latestResult->id)
            ->orderBy('calibration_date', 'desc')
            ->first();

        if (! $previousResult) {
            return 'NEW';
        }

        $expectedDate = $previousResult->calibration_date->addMonths($this->calibration_freq);
        $actualDate = $latestResult->calibration_date;

        if ($actualDate->lt($expectedDate->copy()->subMonth())) {
            return 'EARLY';
        } elseif ($actualDate->gt($expectedDate->copy()->addMonth())) {
            return 'DELAY';
        } else {
            return 'ON TIME';
        }
    }
}
