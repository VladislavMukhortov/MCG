<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendEmailRequest extends FormRequest
{

    protected $errorBag = 'email';

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
            'subject' => 'max:40',
            'body' => 'required|max:1000'
        ];
    }

    public function messages ()
    {
        return [
                'subject.max' => 'Subject can be maximum 40 symbols length.',
                'subject.regex' => 'In subject Only numbers and latin letters is allowed.',
                'body.required' => 'Message cannot be empty.',
                'body.min' => 'Message shall contain at least one character.',
                'body.max' => 'Message can be only 10000 symbols length.',
                'body.regex' => 'In message only numbers and latin letters is allowed.',
        ];
    }
}
