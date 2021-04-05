<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmailRequest extends FormRequest
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
            'user_id' => 'integer',
            'title' => 'required|max:100',
            'body' => 'max:1000',
            'email' => 'email',
            'lead_id' => 'integer',
            'request_id' => 'integer',
            'estimate_id' => 'integer'
            ];

    }
}
