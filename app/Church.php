<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Church extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'district_id',
        'name'
    ];

    public function district() {
        return $this->belongsTo(District::class);
    }
}
