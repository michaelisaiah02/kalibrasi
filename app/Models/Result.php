<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    /** @use HasFactory<\Database\Factories\ResultFactory> */
    use HasFactory;

    protected $fillable = [
        'id_num',
        'calibration_date',
        'calibrator_equipment',
        'param_01',
        'param_02',
        'param_03',
        'param_04',
        'param_05',
        'param_06',
        'param_07',
        'param_08',
        'param_09',
        'param_10',
        'judgement',
        'created_by'
    ];

    public function masterList()
    {
        return $this->belongsTo(\App\Models\MasterList::class, 'id_num', 'id_num');
    }

    public function calibrator()
    {
        return $this->belongsTo(\App\Models\MasterList::class, 'calibrator_equipment', 'id_num');
    }


    public function creator()
    {
        return $this->belongsTo(\App\Models\User::class, 'created_by', 'idKaryawan');
    }
}
