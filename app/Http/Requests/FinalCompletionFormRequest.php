<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FinalCompletionFormRequest extends FormRequest
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
            'first_name' => 'required|min:2|max:30|regex:/^[A-Za-z+$/u',
            'last_name' => 'required|min:2|max:30|regex:/^[A-Za-z]+$/u',
            'design_pros' => 'max:1000|regex:/^[A-Za-z0-9]+$/u',
            'design_cons' => 'max:1000|regex:/^[A-Za-z0-9]+$/u',
            'work_add' => 'max:1000|regex:/^[A-Za-z0-9]+$/u',
            'work_remove' => 'max:1000|regex:/^[A-Za-z0-9]+$/u',
            'work_change' => 'max:1000|regex:/^[A-Za-z0-9]+$/u',
            'work_question' => 'max:1000|regex:/^[A-Za-z0-9]+$/u',
        ];
    }

    public function messages ()
    {
        return [
            'first_name.required' => 'First name is required.',
            'first_name.min' => 'First name is too short(min 2 symbols).',
            'first_name.max' => 'First name is too long(max 30 symbols).',
            'first_name.regex' => 'Only A-z is allowed',
            'last_name.required' => 'Last name is required.',
            'last_name.min' => 'Last name is too short(min 2 symbols).',
            'last_name.max' => 'Last name is too long(max 30 symbols).',
            'last_name.regex' => 'Only A-z is allowed',
            'design_pros.max' => 'Field is too long(max 1000 symbols).',
            'design_pros.regex' => 'Only A-z is allowed',
            'design_cons.max' => 'Field is too long(max 1000 symbols).',
            'design_cons.regex' => 'Only A-z is allowed',
            'work_add.max' => 'Field is too long(max 1000 symbols).',
            'work_add.regex' => 'Only A-z is allowed',
            'work_remove.max' => 'Field is too long(max 1000 symbols).',
            'work_remove.regex' => 'Only A-z is allowed',
            'work_change.max' => 'Field is too long(max 1000 symbols).',
            'work_change.regex' => 'Only A-z is allowed',
            'work_question.max' => 'Field is too long(max 1000 symbols).',
            'work_question.regex' => 'Only A-z is allowed',
        ];
    }
}
