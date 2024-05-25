<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BookRequest;
use App\Models\Book;
use App\Traits\Error;
use App\Traits\Helpers;


class BookController extends Controller
{
    use Error, Helpers;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if($this->can('book-all')) {
            return response()->json(['message'=>"Permission denied!"],403);
        }
        $books = Book::with("author:author_name,id")->select('id','title','published_date','isbn_number','total_copies','author_id','available_copies')->get();
        return response()->json($books);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookRequest $request)
    {
        if($this->can('book-create')) {
            return response()->json(['message'=>"Permission denied!"],403);
        }
         $book = new Book();
         $book->title = $request->title;
         $book->published_date = $request->published_date;
         $book->isbn_number = $request->isbn_number;
         $book->available_copies = $request->total_copies;
         $book->total_copies = $request->total_copies;
         $book->author_id = $request->author_id;
         if($book->save()){
            return response()->json(['message' => 'Book Created successfully'], 201);
         }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BookRequest $request, Book $book)
    {
        if($this->can('book-edit')) {
            return response()->json(['message'=>"Permission denied!"],403);
        }
        $book->title = $request->title;
        $book->published_date = $request->published_date;
        $book->isbn_number = $request->isbn_number;
        $book->total_copies = $request->total_copies;
        $book->author_id = $request->author_id;
        if($book->save()){
            return response()->json(['message' => 'Book Updated successfully']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        if($this->can('book-delete')) {
            return response()->json(['message'=>"Permission denied!"],403);
        }
        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }
        $book->delete();
        return response()->json(['message' => 'Book deleted successfully'], 200);
    }
}
