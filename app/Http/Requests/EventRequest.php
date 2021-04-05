<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'created_by'   =>  ['required','created_by','integer'],
            'type'         =>  'required|string|max:500',
            'description'  =>  'text|min:5|max:500',
            'link'         =>  'string|min:5|max:100',
            'date'         =>  'string|min:5|max:100',
            'time'         =>  'string|min:5|max:100',
        ];
    }
}
