<?php

namespace App\Http\Requests\Project;

use Illuminate\Foundation\Http\FormRequest;

class ProjectPayoutRequest extends FormRequest
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
            'subcontractor_id'  => 'required|integer|exists:subcontractors,id',
            'amount'            => 'required',
            'status_id'         => 'required|integer|exists:payout_statuses,id',
            'date'              => 'required|date',
        ];
    }
}
