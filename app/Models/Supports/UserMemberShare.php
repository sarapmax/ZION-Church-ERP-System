<?php

namespace App\Models\Supports;

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
    * Relate to user's cell.
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function cell() {
        return $this->belongsTo(Cell::class);
    }
}
