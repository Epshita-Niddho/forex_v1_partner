<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DemoAccountRequest extends FormRequest
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
            'firstname' => 'required',
            'lastname' => 'required',
            'phone_number' => 'required',
            'currency_name' => 'required',
            'email' => 'required|email',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'firstname.required' => 'First Name Required',
            'lastname.required' => 'Last Name Required',
            'phone_number.required' => 'Phone Number Required',
            'currency_name.required' => 'Please Select a Currency.',
            'email.required' => 'Please Provide Email.',
            'email.email' => 'Please Provide Valid Email.',
        ];
    }
}
