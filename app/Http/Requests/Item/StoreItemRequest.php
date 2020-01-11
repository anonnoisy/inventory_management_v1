<?php

namespace App\Http\Requests\Item;

use Illuminate\Foundation\Http\FormRequest;

class StoreItemRequest extends FormRequest
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
            'category_id' => 'required',
            'brand_id' => 'required',
            'name' => 'required|string|min:6|max:30',
            'code_name' => 'nullable',
            'description' => 'nullable|max:150',
            'price' => 'required|integer',
            'quantity' => 'required|integer|min:1'
        ];
    }
}
