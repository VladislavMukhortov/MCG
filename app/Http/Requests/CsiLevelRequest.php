<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CsiLevelRequest extends FormRequest
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
            'type'                  =>  ['required','string','max:155'],
            'level_name'            =>  'required|string',
            'level_description'     =>  'required|string',
            'parent_lvl_id'         =>  'required|integer',
        ];
    }
}
