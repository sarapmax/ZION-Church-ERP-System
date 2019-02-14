<?php

namespace App\Models;

use App\Enums\MariageStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
     * @return BelongsTo
     */
    public function member() {
        return $this->belongsTo(Member::class);
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
