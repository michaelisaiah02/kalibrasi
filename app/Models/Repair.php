<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repair extends Model
{
    /** @use HasFactory<\Database\Factories\RepairFactory> */
    use HasFactory;

    protected $fillable = [
        'id_num',
        'problem_date',
        'repair_date',
        'problem',
        'countermeasure',
        'pic_repair',
        'judgement',
    ];

    protected $casts = [
        'problem_date' => 'date',
        'repair_date' => 'date',
    ];

    public function masterList()
    {
        return $this->belongsTo(MasterList::class, 'id_num', 'id_num');
    }
}
