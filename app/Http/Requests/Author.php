<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Author extends FormRequest
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
            'author_name' => 'required',
            'author_code' => 'required',
            'author_bank_account' => 'required',
            'author_bank_name' => 'required',
        ];
    }
}
