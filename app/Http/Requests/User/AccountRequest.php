<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AccountRequest extends FormRequest
{
    public function prepareForValidation()
    {
        if ($this->request->get('password')) {
            if (!Hash::check($this->request->get('current_password') , Auth::user()->password)) {
                throw ValidationException::withMessages(['current_password' => 'Sorry, try again.']);
            }

        }
    }

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
            'name'                  => 'sometimes|string|max:255',
            'email'                 => 'sometimes|email|unique:users,email,' . Auth::id(),
            'email_signature'       => 'nullable|string|max:512',
            //todo password rule
            'password'              => 'sometimes|min:6|confirmed|min:6',
            'current_password'      => 'required_if:password,*|min:6',
            'password_confirmation' => 'required_if:password,*|min:6',
        ];
    }

    public function messages()
    {
        return [
            //
        ];
    }
}
