<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EstimateLeadForm extends FormRequest
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
            'estimate_id' =>  'required|integer',
            'file'        =>  'string|min:5|max:100',
            'premise_id'  =>  'integer',
            'phase_id'    =>  'integer',
            'page_number' =>  'string|min:5|max:100',
        ];
    }
}
