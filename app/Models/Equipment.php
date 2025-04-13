<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    protected $table = 'equipments';
    protected $fillable = [
        'type_id',
        'name',
    ];

    public function masterLists()
    {
        return $this->hasMany(MasterList::class);
    }
}
