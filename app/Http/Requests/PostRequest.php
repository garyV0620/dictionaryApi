<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // new created Request type make this true
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        // new created Request type (make your rules here) it will also automatically validate it using the rules
        return [
            'word' => 'required',
            'meaning' => 'required',
            'authors' => 'required',
        ];
    }
}
