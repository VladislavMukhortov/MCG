<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CSICodeCategoryRequest extends FormRequest
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
            'level_id'      => 'required|integer|max:4',
            'parent'        => $this->getParentFieldRule((int)$this->get('level_id')),
            'code'          => 'required|string|max:33',
            'description'   => 'required|string|max:44',
        ];
    }

    private function getParentFieldRule(?int $lvl) :string
    {
        switch ($lvl) {
            case 1:
                return 'nullable|array|max:0';
            case 2:
                return 'required|array|min:1|max:1';
            case 3:
                return 'required|array|min:2|max:2';
            case 4:
                return 'required|array|min:3|max:3';
            default:
                return 'sometimes|array';
        }
    }

    public function messages()
    {
        return [
            'parent.required' => 'Please select code from dropdown list.',
            'parent.min' => 'Please select code from dropdown list.'
        ];
    }
}
