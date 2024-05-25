<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AuthorPostRequest;
use App\Models\Author;
use App\Traits\Error;
use App\Traits\Helpers;


class AuthorController extends Controller
{
    use Error, Helpers;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if($this->can('author-all')) {
            return response()->json(['message'=>"Author View Permission denied!"],403);
        }
        $authors = Author::select('id','author_name','author_bio')->get();
        return response()->json($authors);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AuthorPostRequest $request)
    {
        if($this->can('author-create')) {
            return response()->json(['message'=>"Permission denied!"],403);
        }
            $author = new Author();
            $author->author_name = $request->input('author_name');
            $author->author_bio = $request->input('author_bio');
            if($author->save()){
                return response()->json(['message' => 'Author store stored successfully']);
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
    public function update(AuthorPostRequest $request, Author $author)
    {
        if($this->can('author-edit')) {
            return response()->json(['message'=>"Author update Permission denied!"],403);
        }
        $author->author_name = $request->input('author_name');
        $author->author_bio = $request->input('author_bio');
        if($author->save()){
            return response()->json(['message' => 'Author Updated successfully']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author)
    {
        if($this->can('author-delete')) {
            return response()->json(['message'=>"Author remove Permission denied!"],403);
        }

        if (!$author) {
            return response()->json(['message' => 'Author not found'], 404);
        }
        $author->delete();
        return response()->json(['message' => 'Author deleted successfully'], 200);
    }
}
