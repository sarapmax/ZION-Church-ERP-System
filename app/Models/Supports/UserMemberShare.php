<?php

namespace App\Models\Supports;

use App\Enums\NamePrefix;
use App\Models\AdministrativeStatus;
use App\Models\Cell;
use App\Models\Offering;
use App\Models\ServiceRound;

trait UserMemberShare
{
    /**
    * Concatenate first name and last name together
    *
    * @return string
    */
    public function getFullnameAttribute() {
        return __('name-prefix.' . NamePrefix::getKey($this->name_prefix)) . ' ' . $this->first_name . ' ' . $this->last_name;
    }

    /**
     * @return string
     */
    public function getProfileImagePathAttribute() {
        if ($this->profile_image) {
            return asset('profile-images/' . $this->profile_image);
        }

        return asset('images/profile-image-blank.png');
    }

    /**
     * Relate to user's cell.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cell() {
        return $this->belongsTo(Cell::class);
    }

    /**
     * Get administrative statuses.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function administrativeStatuses()
    {
        return $this->hasMany(AdministrativeStatus::class, 'member_id');
    }

    /**
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function serviceRounds()
    {
        return $this->hasMany(ServiceRound::class, 'member_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function offerings()
    {
        return $this->hasMany(Offering::class, 'financial_officer_id');
    }
}
