<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttachmentFileRequest extends FormRequest
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
            'file'                          => 'required|mimes:jpg,jpeg,png,bmp,txt,tiff,docx,csv,xlsx|file|max:20480',
        ];
    }

    public function messages()
    {
        return [
            'file.required'                         => "You must use the 'File' area to select which file you wish to upload",
            'file.max'                              => "Maximum file size to upload is 20MB (20480 KB)",
        ];
    }
}