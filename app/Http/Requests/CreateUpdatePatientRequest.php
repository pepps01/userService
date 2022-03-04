<?php

namespace App\Http\Requests;

use App\Models\Patient;
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
        $patient = Patient::where('user_id', auth()->user()->id)->first();
        return [
            'firstname' =>  ['required', 'string', 'max:255'],
            'lastname' =>  ['required', 'string', 'max:255'],
            'date_of_birth' => [ 'required', 'date'],
            'phone_number' => ['required', 'numeric', Rule::unique('patients')->ignore($patient->id)],
            'photo' => ['image', 'mimes:jpg,png,jpeg', 'max:4048'],
            'gender' => ['required', 'string', Rule::in(['Male', 'Female'])],
            'country_id' =>  ['required', 'integer'],
            'state_id' =>  ['required', 'integer'],
        ];
    }
}
