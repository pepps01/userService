<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateUserRequest extends FormRequest
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
            'firstname' =>  ['required', 'string', 'max:255'],
            'lastname' =>  ['required', 'string', 'max:255'],
            'email' =>  ['required', 'email', 'max:255', 'unique:users,email'],
            'password' =>  ['required', 'string', 'max:255', 'min:6', 'confirmed'],
            'role_id' => ['string', Rule::in([9, 18, 27, 36, 45, 54, 63, 72, 81])],
            'application_name' => ['required', 'string'],
            'date_of_birth' => ['required', 'date'],
        ];
    }
}
