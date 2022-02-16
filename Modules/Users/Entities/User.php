<?php

namespace Modules\Users\Entities;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'name', 'email' ];

    protected $hidden = ['password', 'email_verified_at'];

    protected $table = 'users';

    protected $guard_name = 'web';

    protected static function boot()
    {
        parent::boot();

        static::saved(function (User $item) {

        });

        static::deleting(function (User $item) {


        });

    }
}
