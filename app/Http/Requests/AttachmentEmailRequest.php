<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttachmentEmailRequest extends FormRequest
{

    protected $errorBag = 'attachment';


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
        return  [
            'condition' => 'max:100000|mimetypes:image/jpeg,image/jpg,image/png,pdf',
            'concept'=>'max:100000|mimetypes:image/jpeg,image/jpg,image/png,pdf',
            'plan'=>'max:100000|mimetypes:image/jpeg,image/jpg,image/png,pdf',
        ];
    }

    public function messages ()
    {
        return [

            'condition.max' => 'The selected condition file is too large. Please upload a file less than 100 megabytes.',
            'concept.max' => 'The selected concept file is too large. Please upload a file less than 100 megabytes.',
            'plan.max' => 'The selected plan file is too large. Please upload a file less than 100 megabytes.',
            'condition.mimetypes' => 'The selected file type is not supported for condition. Please upload the file type Jpeg, Png, Pdf.',
            'concept.mimetypes' => 'The selected file type is not supported for concept. Please upload the file type Jpeg, Png, Pdf.',
            'plan.mimetypes' => 'The selected file type is not supported for plan. Please upload the file type Jpeg, Png, Pdf.'

        ];
    }
}
