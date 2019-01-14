<?php

namespace App;

use App\Enums\AdministrativeStatusEnum;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

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
    protected $dates = [
        'birthday'
    ];

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
        static::creating(function ($user) {
            $userCode = sprintf("%06s", sprintf("%06s", User::count() + 1));

            $user->code = $userCode;
            $user->password = bcrypt($userCode);
            $user->administrative_status = AdministrativeStatusEnum::USER;
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
    public function getAdministrativeRoleAttribute() {
        return new AdministrativeStatusEnum($this->administrative_status);
    }

    /**
     * Get user's addresses.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function addresses() {
        return $this->morphMany(Address::class, 'addressable');
    }

    public function emergencyContact() {
        return $this->hasOne(EmergencyContact::class);
    }

    public function mariage() {
        return $this->hasOne(Mariage::class);
    }
}
