<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cell extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'church_id',
        'name'
    ];

    public function church() {
        return $this->belongsTo(Church::class);
    }
}
