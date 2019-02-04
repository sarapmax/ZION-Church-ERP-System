<?php

namespace App\Models\Supports;

use App\Models\AdministrativeStatus;
use App\Models\Cell;

trait UserMemberShare
{
    /**
    * Concatenate first name and last name together
    *
    * @return string
    */
    public function getFullnameAttribute() {
        return $this->first_name . ' ' . $this->last_name;
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
}
