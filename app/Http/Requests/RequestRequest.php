<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestRequest extends FormRequest
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
            'lead' => 'required|integer',
            'status' => 'integer',
            'request_information' => 'required|max:5000',
            'floor_plan_attachments' => 'nullable|integer',
            'existing_condition_attachment' => 'nullable|integer',
            'concept_photo_attachments' => 'nullable|integer',
            'floor_plan_uploaded' => 'nullable|integer',
            'existing_condition_uploaded' => 'nullable',
            'concept_photo_uploaded' => 'nullable',
            'attachment_link_sent' => 'nullable|integer',
            'type' => 'nullable|integer',
            'stage' => 'nullable|integer',
            'startdate' => 'nullable|'

        ];
    }

    public function messages ()
    {
        return [
            'request_information.max' => 'Text is too long(5000 symbols max).',
            'roominfo.max' => 'Text is too long(3000 symbols max).',
        ];
    }
}