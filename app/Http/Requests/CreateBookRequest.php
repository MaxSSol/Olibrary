<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property mixed $title
 * @property mixed $description
 * @property mixed $bookFile
 * @property mixed $authors
 */
class CreateBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->isAdmin() || $this->user()->isModer();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:255|unique:books',
            'description' => 'required|max:65550',
            'bookFile' => 'required|file|max:10240',
            'bookImage' => 'file|max:10240|mimes:jpg,bmp,png,jpeg',
            'authors' => 'required|array',
        ];
    }
}
