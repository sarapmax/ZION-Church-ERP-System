<?php

namespace App\Models;

use App\Enums\OfferingType;
use Illuminate\Database\Eloquent\Model;

class Offering extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'financial_officer_id',
        'service_round_id',
        'member_id',
        'type',
        'amount',
        'need_receipt'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function serviceRound()
    {
        return $this->belongsTo(ServiceRound::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
