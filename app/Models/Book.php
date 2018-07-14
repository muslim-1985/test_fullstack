<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Book
 *
 * @mixin \Eloquent
 */
class Book extends Model
{
    protected $fillable = ['name', 'publishing', 'image', 'publishing_houses_id'];

    public function publishingHouse ()
    {
        return $this->belongsTo('App\Models\PublishingHouse','publishing_houses_id');
    }
    public function authors ()
    {
        return $this->belongsToMany('App\Models\Author', 'books_authors', 'book_id', 'author_id');
    }
}
