<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlatUkur extends Model
{
    protected $fillable = [
        'tipe_id',
        'nama_alat',
    ];

    public function masterLists()
    {
        return $this->hasMany(MasterList::class);
    }
}
