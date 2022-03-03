<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class CreateUpdatePatientRequest extends FormRequest
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
            'date_of_birth' => [ 'required', 'date'],
            'phone_number' => ['required', 'numeric', Rule::unique('patients')->ignore($this->route('id'))],
            'photo' => ['required', 'image', 'mimes:jpg,png,jpeg', 'max:4048'],
        ];
    }
}
