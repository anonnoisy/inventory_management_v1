<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
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
            'firstname' => 'required|string|min:6',
            'lastname' => 'nullable|string',
            'number_id' => 'required|integer|min:14',
            'phone' => 'required|min:11|numeric',
            'email' => 'required|email',
            'address' => 'required|min:15|max:100',
            'postcode' => 'required|digits:5',
            'image' => 'nullable',
        ];
    }
}
