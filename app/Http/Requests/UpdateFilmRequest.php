<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFilmRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3',
            'language' => 'required',
            'actor' => 'required|min:3',
            'director' => 'required|min:3',
            'genre' => 'required|min:3',
            'description' => 'required',
            'link' => 'required',
        ];
    }
}
