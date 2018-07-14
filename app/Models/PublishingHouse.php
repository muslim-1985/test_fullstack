<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PublishingHouse
 *
 * @mixin \Eloquent
 */
class PublishingHouse extends Model
{
    protected $fillable = ['name'];

    public function books ()
    {
        return $this->hasMany('App\Models\Book','publishing_houses_id');
    }
}
