<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Standard extends Model
{
    /** @use HasFactory<\Database\Factories\StandardFactory> */
    use HasFactory;

    protected $fillable = [
        'id_num',
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
    ];

    public function masterList()
    {
        return $this->belongsTo(MasterList::class, 'id_num', 'id_num');
    }
}
