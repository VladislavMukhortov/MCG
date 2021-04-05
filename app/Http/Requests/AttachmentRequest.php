<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AttachmentRequest extends FormRequest
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
            'attachment_description'        => 'required|string|max:512',
            'file'                          => 'required|string',
            'subcontractor'                 => 'nullable|integer|exists:subcontractors,id',
            'general_contractor'            => 'nullable|integer|exists:general_contractors,id',
            'project'                       => 'nullable|integer|exists:projects,id',
            'uploaded_by'                   => 'required|integer|exists:users,id',
            'lead'                          => 'nullable|integer|exists:leads,id',
            'estimate'                      => 'nullable|integer|exists:estimate_repositories,id',
            'request'                       => 'nullable|integer|exists:requests,id',
            'ticket'                        => 'nullable|integer|exists:tickets,id',
            'line_item'                     => 'nullable|integer|exists:estimate_repository_line_items',

        ];
    }
}
