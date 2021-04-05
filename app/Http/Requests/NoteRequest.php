<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NoteRequest extends FormRequest
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
            'notes' => 'required|min:2|max:2000',
            'created_by' => 'nullable|integer',
            'contact' => 'nullable|integer',
            'task' => 'nullable|integer',
            'general_contractor' => 'nullable|integer',
            'subcontractor' => 'nullable|integer',
            'project' => 'nullable|integer',
            'lead' => 'nullable|integer',
            'estimate' => 'nullable|integer',
            'request' => 'nullable|integer',
            'ticket' => 'nullable|integer',
            'line_item' => 'nullable|integer',
        ];
    }

    public function messages ()
    {
        return [
            'notes.required' => 'Field is required.',
            'notes.min' => 'Note is too short(min 2 symbols).',
            'notes.max' => 'Note is too long(max 2000 symbols).',
        ];
    }
}
