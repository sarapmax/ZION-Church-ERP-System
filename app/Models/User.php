<?php
namespace App\Models;

use App\Enums\AdministrativeStatusEnum;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Concatenate first name and last name together
     *
     * @return string
     */
    public function getFullnameAttribute() {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * Get member's administrative status;
     *
     * @return AdministrativeStatusEnum
     * @internal param $attribute
     */
    public function getAdministrativeStatusNameAttribute() {
        return (new AdministrativeStatusEnum($this->attributes['administrative_status']))->getKey();
    }
}
