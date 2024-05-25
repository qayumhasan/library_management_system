<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'published_date' => 'required|date|date_format:Y-m-d',
            'available_copies' => 'integer|min:0|nullable',
            'isbn_number' => 'required|string|max:255',
            'total_copies' => 'required|integer|min:1',
            'author_id' => 'required|exists:authors,id',
        ];
    }
}
