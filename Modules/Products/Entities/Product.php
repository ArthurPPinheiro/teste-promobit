<?php

namespace Modules\Products\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Tags\Entities\Tag;

class Product extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'name'];

    protected $table = 'product';

    protected $guard_name = 'web';

    protected static function boot()
    {
        parent::boot();

        static::saved(function (Product $item) {
        });

        static::deleting(function (Product $item) {
        });

    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'product_tag', 'product_id', 'tag_id');
    }
}
