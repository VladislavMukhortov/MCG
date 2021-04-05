<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InitialFormRequest extends FormRequest
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
            'name' => 'required|min:2|max:100',
            'last_name' => 'required|min:2|max:100',
            'phone' => 'required|integer',
          //  'email' => 'required|email|unique:leads,email',
            'created' => 'required',
            'address' => 'required',
            'street' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required|integer',
            'type' => 'required|integer',
            'stage' => 'required|integer',
            'start_date' => 'required|integer',
            'stage_room' => 'required|integer',
            'ceiling' => 'nullable|integer',
            'walls' => 'nullable|integer',
            'wall_partition' => 'nullable|integer',
            'floor' => 'nullable|integer',
            'base_board' => 'nullable|integer',
            'crown_molding' => 'nullable|integer',
            'interior_door' => 'nullable|integer',
            'closest_door' => 'nullable|integer',
            'closest_organization' => 'nullable|integer',
            'window' => 'nullable|integer',
            'light_fixture' => 'nullable|integer',
            'room_size' => 'nullable',
            'room_info' => 'nullable',
            'room_inspiration_external' => 'nullable',
            'recessed_light' => 'nullable|integer',
            'wall_fixture' => 'nullable|integer',
            'ceiling_fixture' => 'nullable|integer',
            'bathroom_current' => 'nullable|integer',
            'bathroom_replace' => 'nullable|integer',

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
