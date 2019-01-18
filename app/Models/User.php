<?php

namespace App\Models;

use App\Enums\AdministrativeStatusEnum;
use App\Enums\SpiritualStatusEnum;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cell_id',
        'email',
        'spiritual_status',
        'first_name',
        'last_name',
        'nickname',
        'gender',
        'birthday',
        'idcard',
        'race',
        'nationality',
        'mobile_number',
        'facebook',
        'line',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at', 'birthday'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot() {
        parent::boot();

        // Format the user id to always start from 6 digits.
        static::created(function ($user) {
            $userCode = sprintf("%06s", sprintf("%06s", $user->id));

            $user->code = $userCode;
            $user->password = bcrypt($userCode);
            $user->administrative_status = AdministrativeStatusEnum::USER;

            $user->save();
        });
    }

    /**
     * Concatenate first name and last name together
     *
     * @return string
     */
    public function getFullnameAttribute() {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * Get user's administrative status;
     *
     * @return AdministrativeStatusEnum
     * @internal param $attribute
     */
    public function getAdministrativeStatusAttribute() {
        return (new AdministrativeStatusEnum($this->attributes['administrative_status']))->getKey();
    }

    /**
     * Get user's spiritual status;
     *
     * @return SpiritualStatusEnum
     * @internal param $attribute
     */
    public function getSpiritualStatusNameAttribute() {
        return (new SpiritualStatusEnum($this->spiritual_status))->getKey();
    }

    /**
     * Relate user's addresses.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function addresses() {
        return $this->morphMany(Address::class, 'addressable');
    }

    /**
     * Relate to user's emergency contact.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function emergencyContact() {
        return $this->hasOne(EmergencyContact::class);
    }


    /**
     * Relate to user's marigae imformation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function mariage() {
        return $this->hasOne(Mariage::class);
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
     * Check whether a user has the same address or not.
     *
     * @return bool
     */
    public function getSameAddressAttribute() {
        return $this->addresses->count() == 1;
    }
}
