<?php

namespace App\Http\Requests;

use App\Rules\AlphaNumeric;
use Illuminate\Foundation\Http\FormRequest;

class CsiCodeRequest extends FormRequest
{
    protected function prepareForValidation()
    {
//        $this->merge([
//            'categories' => collect($this->get('categories'))->filter()->unique()->toArray()
//        ]);
//        if (is_null($this->get('categories'))) {
//            $this->merge([
//                'categories' => []
//            ]);
//        }
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
            'code_name'             => ['required','string','max:155'],
            'level_1_id'            =>  'integer',
            'level_2_id'            =>  'integer',
            'level_3_id'            =>  'integer',
            'level_4_id'            =>  'integer',
            'building_material'     => 'required|integer|max:100',
            'decoration_material'   => 'required|integer|max:100',
            'labor'                 => 'required|integer|max:100',
            'subcontractors'        => 'required|integer|max:100',
            'manufacturing'         => 'required|integer|max:100',
        ];
    }
}
