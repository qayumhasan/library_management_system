<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BorrowdBook;
use App\Http\Requests\BorrowdBookRequest;
use App\Traits\Error;
use App\Traits\Helpers;

class BorrowdBookController extends Controller
{
    use Error, Helpers;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {if($this->can('borrowd-book-all')) {
        return response()->json(['message'=>"Permission denied!"],403);
    }
        $borrowdBooks = BorrowdBook::with('member','book.author')->select('id','member_id','book_id','borrow_date','return_date','status')->get();
        return response()->json($borrowdBooks);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BorrowdBookRequest $request)
    {
        if($this->can('borrowd-book-create')) {
            return response()->json(['message'=>"Permission denied!"],403);
        }
    $borrowd = new BorrowdBook();
    $borrowd->member_id = $request->input('member_id');
    $borrowd->book_id = $request->input('book_id');
    $borrowd->borrow_date = $request->input('borrow_date');
    $borrowd->return_date = $request->input('return_data');
    $borrowd->status = $request->input('status');
    if($borrowd->save()){
        return response()->json(['message' => 'Book Borrowd successfully'], 201);
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
    public function update(Request $request, BorrowdBook $borrowdBook)
    {
        if($this->can('borrowd-book-edit')) {
            return response()->json(['message'=>"Permission denied!"],403);
        }
        $borrowdBook->member_id = $request->input('member_id');
        $borrowdBook->book_id = $request->input('book_id');
        $borrowdBook->borrow_date = $request->input('borrow_date');
        $borrowdBook->return_date = $request->input('return_data');
        $borrowdBook->status = $request->input('status');
        if($borrowdBook->save()){
            return response()->json(['message' => 'Book Borrowd successfully'], 201);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BorrowdBook $borrowdBook)
    {
        if($this->can('borrowd-book-delete')) {
            return response()->json(['message'=>"Permission denied!"],403);
        }
        if (!$borrowdBook) {
            return response()->json(['message' => 'Item not found'], 404);
        }
        try {
            $borrowdBook->delete();
        } catch (\Exception $th) {
            dd($th);
        }
        return response()->json(['message' => 'Row deleted successfully'], 200);
    }
}
