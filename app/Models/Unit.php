<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    /** @use HasFactory<\Database\Factories\UnitFactory> */
    use HasFactory;

    protected $fillable = ['symbol', 'name'];

    public function masterLists()
    {
        return $this->hasMany(MasterList::class, 'unit_id');
    }
}
