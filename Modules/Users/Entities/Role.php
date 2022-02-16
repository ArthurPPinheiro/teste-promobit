<?php

namespace Modules\Users\Entities;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends \Spatie\Permission\Models\Role
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'name', 'guard_name' ];

    protected $table = 'roles';

    protected static function boot()
    {
        parent::boot();

        static::saved(function (Role $item) {

        });

        static::deleting(function (Role $item) {


        });

    }
}
