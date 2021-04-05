<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoomRequest extends FormRequest
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
            'request_id' => 'required|integer',
            'stageroom' => 'nullable|integer',
            'ceiling' => 'nullable|integer',
            'walls' => 'nullable|integer',
            'wallpartition' => 'nullable|integer',
            'floor' => 'nullable|integer',
            'baseboard' => 'nullable|integer',
            'crownmolding' => 'nullable|integer',
            'interiordoor' => 'nullable|integer',
            'closestdoor' => 'nullable|integer',
            'closestorganization' => 'nullable|integer',
            'window' => 'nullable|integer',
            'lightfixture' => 'nullable|integer',
            'roomsize' => 'nullable|max:3000',
            'roominfo' => 'nullable|max:3000',
            'roominspirationexternal' => 'nullable',
            'recessedlight' => 'nullable|integer',
            'wallfixture' => 'nullable|integer',
            'ceilingfixture' => 'nullable|integer',
            'bathroomcurrent' => 'nullable|integer',
            'bathroomreplace' => 'nullable|integer',

        ];
    }

    public function messages ()
    {
        return [
            'roomsize.max' => 'Text is too long(3000 symbols max).',
            'roominfo.max' => 'Text is too long(3000 symbols max).',
        ];
    }
}