<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BorrowdBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
        'borrow_date' => 'required|date',
        'member_id' => 'required|exists:members,id',
        'book_id' => 'required|exists:books,id',
        'return_date' => 'nullable|date',
        'status' => 'required|in:Borrowed,Returned,Overdue',
        ];
    }
}
