<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Author
 *
 * @mixin \Eloquent
 */
class Author extends Model
{
    protected $fillable = ['name'];


    public function books ()
    {
        return $this->belongsToMany('App\Models\Book', 'books_authors', 'author_id', 'book_id');
    }
}
