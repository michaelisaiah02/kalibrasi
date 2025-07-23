<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IncompleteInput extends Model
{
    protected $fillable = [
        'user_id',
        'master_list_id',
        'stage',
    ];

    /**
     * Relasi ke user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke master list / equipment
     */
    public function masterList()
    {
        return $this->belongsTo(MasterList::class, 'master_list_id', 'id');
    }

    public function scopeForCurrentUser($query)
    {
        return $query->where('user_id', auth()->id());
    }

    public function scopeAtStage($query, $stage)
    {
        return $query->where('stage', $stage);
    }
}
