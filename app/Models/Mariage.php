<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Mariage extends Model
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
        'status',
        'spouse_name',
        'spouse_nickname',
        'spouse_birthday',
        'spouse_christian',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['spouse_birthday'];

    /**
     * Relate to user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

    /**
     * Get spouse's age.
     *
     * @return int
     */
    public function getAgeAttribute() {
        return Carbon::parse($this->spouse_birthday)->age;
    }
}
