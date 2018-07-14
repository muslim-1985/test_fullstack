<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AppController;
use App\Models\Author;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthorController extends AppController
{
    public function storeAuthor (Request $request)
    {
        $request->validate([
            'name'=>'required|max:255'
        ]);
        try {
            Author::create($request->all());
            return response()->json(['message' => 'Author create success']);
        } catch (\Exception $e) {
            return response()->json(['message'=>'some error'], 500);
        }
    }

    public function getAuthors ()
    {
        try {
            $authors = Author::all();
            return response()->json(['authors' => $authors]);
        } catch (\Exception $e) {
            return response()->json(['message'=>'some error'], 500);
        }
    }
}
