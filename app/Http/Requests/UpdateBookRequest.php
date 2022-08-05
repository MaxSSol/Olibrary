<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

/**
 * @property mixed $title
 * @property mixed $description
 * @property mixed $bookFile
 * @property mixed $authors
 */

class UpdateBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->isAdmin() || Auth::user()->isModer();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:255',
            'description' => 'required|max:65550',
            'bookFile' => 'max:1024',
            'bookImage' => 'max:1024|mimes:jpg,bmp,png,jpeg',
            'authors' => 'required|array',
        ];
    }
}
