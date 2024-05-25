<?php

namespace App\Observers;

use App\Models\BorrowdBook;

class BorrowObserver
{
    /**
     * Handle the BorrowdBook "created" event.
     */
    public function created(BorrowdBook $borrowdBook): void
    {
        if($borrowdBook->status == "Returned"){
            {
                $borrowdBook->book()->increment('available_copies',1);
            }

        }
        if($borrowdBook->status == "Borrowed"){
            $borrowdBook->book()->decrement('available_copies',1);
        }

    }

    /**
     * Handle the BorrowdBook "updated" event.
     */
    public function updated(BorrowdBook $borrowdBook): void
    {
        if($borrowdBook->status == "Returned"){
            {
                $borrowdBook->book()->increment('available_copies',1);
            }

        }
        if($borrowdBook->status == "Borrowed"){
            $borrowdBook->book()->decrement('available_copies',1);
        }
    }

    /**
     * Handle the BorrowdBook "deleted" event.
     */
    public function deleted(BorrowdBook $borrowdBook): void
    {
                $borrowdBook->book()->increment('available_copies',1);


    }

    /**
     * Handle the BorrowdBook "restored" event.
     */
    public function restored(BorrowdBook $borrowdBook): void
    {
        //
    }

    /**
     * Handle the BorrowdBook "force deleted" event.
     */
    public function forceDeleted(BorrowdBook $borrowdBook): void
    {
        //
    }
}
