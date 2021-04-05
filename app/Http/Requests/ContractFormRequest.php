<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContractFormRequest extends FormRequest
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
            'name' => 'required|alpha|min:2|max:20',
            'last_name' => 'nullable|alpha|min:2|max:35',
            'email' => 'required',
            'phone' => 'required|numeric|digits:11',
            'city' => 'nullable|min:5|max:45',
            'zip' => 'nullable|numeric|digits_between:5,9',
            'street' => 'nullable|min:5|max:60',
            'state' => 'required',
            'address' => 'nullable|min:5|max:60',
        ];
    }
}
