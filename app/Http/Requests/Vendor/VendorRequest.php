<?php

namespace App\Http\Requests\Vendor;

use Illuminate\Foundation\Http\FormRequest;

class VendorRequest extends FormRequest
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
            'vendor_name' => 'required',
            'email' => 'required|email',
            'phone' => 'nullable|numeric',
            'mobile' => 'required|numeric',
            'address' => 'required',
            'description' => 'nullable',
            'image' => 'nullable',
        ];
    }
}
