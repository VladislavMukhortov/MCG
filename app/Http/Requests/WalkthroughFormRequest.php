<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WalkthroughFormRequest extends FormRequest
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
            'first_name' => 'required|min:2|max:20',
            'last_name' => 'required|min:2|max:35',
            'email' => 'required|email',
            'details' => 'max:300',
            'address' => 'max:300',
            'phone' => 'max:300',
            'meeting_timestamp' => 'required',
        ];
    }
}
