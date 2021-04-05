<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EstimateFormPhase extends FormRequest
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
            'estimate_id'  =>  'required|integer',
            'premise_name' =>  'string|min:5|max:100',
            'phase_name'   =>  'string|min:5|max:100',
            'description'  =>  'text|min:5|max:500',
            'timeline'     =>  'string|min:5|max:100',
        ];
    }
}
