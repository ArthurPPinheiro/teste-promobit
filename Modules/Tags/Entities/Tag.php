<?php

namespace Modules\Tags\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Products\Entities\Product;

class Tag extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'name'];

    protected $table = 'tag';

    protected $guard_name = 'web';

    protected static function boot()
    {
        parent::boot();

        static::saved(function (Tag $item) {

        });

        static::deleting(function (Tag $item) {


        });

    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_tag');
    }
}
