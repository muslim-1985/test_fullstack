<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AppController;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends AppController
{
    public function index()
    {
        return view('bookCatalog/index');
    }
    public function store (Request $request)
    {
        $request->validate ([
            'authors' => 'required',
            'publishing_houses_id' => 'required',
            'name' => 'required',
            'publishing' => 'required',
            'image' => 'required'
        ]);
       // предварительная работа с изображениями ведется в Http/Provides/AppServiceProvider
        try {
            //декодируем данные которые прилетели к нам с фронта
            $authors_id = json_decode($request->input('authors'));
            $book = Book::create($request->all());
            //синхронизируем с авторами
            if($request->input('authors')) {
                $book->authors()->sync($authors_id);
            }
            return response()->json(['message' => 'Book create success']);
        } catch (\Exception $e) {
            return response()->json(['message'=>$e->getMessage()], 500);
        }
        //return response()->json($authors_id);
    }
    public function getBooks ()
    {
        try {
            $books = Book::with('authors', 'publishingHouse')->get();
            return response()->json(['books' => $books]);
        } catch (\Exception $e) {
            return response()->json(['message'=>$e->getMessage()], 500);
        }
    }

    public function destroyBook ($id)
    {
        $book = Book::findOrFail($id);
        try {
            $book->authors()->detach();
            $book->delete();
            return response()->json(['message' => 'Delete success']);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }
}
