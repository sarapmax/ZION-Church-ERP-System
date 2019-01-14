<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmergencyContact extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'nickname',
        'age',
        'relationship',
        'mobile_number',
    ];

    public function user() {
        $this->belongsTo(User::class);
    }

    public function address() {
        return $this->morphOne(Address::class, 'addressable');
    }
}
