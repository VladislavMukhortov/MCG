<?php

namespace App\Http\Requests;

use App\Models\Leads;
use Illuminate\Foundation\Http\FormRequest;

class LeadsRequest extends FormRequest
{

    protected $errorBag = 'lead';

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
     * @param Leads $lead
     * @return array
     */
    public function rules(Leads $lead)
    {
        return  [
            'name' => 'required|alpha|min:2|max:20',
            'last_name' => 'nullable|alpha|min:2|max:35',
            'email' => 'required|email',
            'phone' => 'required|numeric|digits:11',
            'city' => 'nullable|min:5|max:45',
            'zip' => 'nullable|numeric|digits_between:5,9',
            'street_address' => 'nullable|min:5|max:60',
            'state' => 'required',
            'address' => 'nullable|min:5|max:60',
//            'first' => 'required|min:5|max:40',
//            'last' => 'nullable|min:5|max:40',
//            'zip'  =>  'min:5|max:9|numeric',
//            'city' => 'min:5|max:45|regex:/^[A-Za-z]+$/u',
//            'address' => 'min:5|max:60|regex:/(^[A-Za-z0-9 ]+$)+/',
//            'phone' => 'required|min:11|max:11|regex:/^[0-9]+$/u',
//            'street_address' => 'min:5|max:60|regex:/^[A-Za-z0-9]+$/u',

//            'company'=>'min:2|max:40|regex:/(^[A-Za-z0-9 ]+$)+/',
//            'project_description'=>'max:10000|regex:/(^[A-Za-z0-9 ]+$)+/',
//            'title'=>'min:2|max:30|regex:/(^[A-Za-z0-9 ]+$)+/',
//            'lead_referral_source'=>'min:2|max:30|regex:/(^[A-Za-z0-9 ]+$)+/',
//            'industry'=>'max:20|regex:/(^[A-Za-z]+$)+/',
//            'rating'=>'min:1|max:5|regex:/^[1-5]+$/u',
        ];
    }
}
