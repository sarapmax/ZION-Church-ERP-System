<?php
namespace App\Models;

use App\Enums\AdministrativeStatusEnum;
use App\Models\Supports\UserMemberShare;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, UserMemberShare;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

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
