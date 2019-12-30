<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Repositories\UserRepository;

class UserRequest extends FormRequest
{

    protected $user;

    /**
     * Class constructor.
     */
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

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
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'email' => 'required|email',
            'phone' => 'nullable|numeric',
            'password' => 'nullable|min:6|confirmed',
            'country' => 'required|string',
            'province' => 'required|string',
            'city' => 'required|string',
            'postalcode' => 'required|numeric|min:4',
        ];

    }
}
