<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unit extends Model
{
    /** @use HasFactory<\Database\Factories\UnitFactory> */
    use HasFactory;

    use SoftDeletes;

    protected $fillable = ['symbol', 'name'];

    protected $dates = ['deleted_at'];

    public function masterLists()
    {
        return $this->hasMany(MasterList::class, 'unit_id');
    }
}
