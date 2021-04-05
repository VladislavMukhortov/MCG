<?php

namespace App\Http\Requests\Project;

use Illuminate\Foundation\Http\FormRequest;

class ProjectUpdateRequest extends FormRequest
{
    public function prepareForValidation()
    {
        if($this->request->get('address')) {
            $this->merge([
                'address' => [
                    'location'  => $this->request->get('address'),
                    'street'    => $this->request->get('street'),
                    'state'     => $this->request->get('state'),
                    'city'      => $this->request->get('city'),
                    'zip'       => $this->request->get('zip'),
                ]
            ]);
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
            'status_id'     => 'sometimes|integer|exists:project_statuses,id',
            'lead_id'       => 'sometimes|integer|exists:leads,id',
            'author_id'     => 'nullable|integer|exists:users,id',
            'name'          => 'required|string|max:255',
            'address'       => 'nullable|array',
            'start_date'    => 'nullable|date',
            'finish_date'   => 'nullable|date',
        ];
    }
}
