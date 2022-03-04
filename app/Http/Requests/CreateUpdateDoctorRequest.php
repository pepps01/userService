<?php

namespace App\Http\Requests;

use App\Models\Doctor;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class CreateUpdateDoctorRequest extends FormRequest
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
        $doctor = Doctor::where('user_id', auth()->user()->id)->first();
        return [
            'firstname' =>  ['required', 'string', 'max:255'],
            'lastname' =>  ['required', 'string', 'max:255'],
            'hospital' =>  ['required', 'string', 'max:255'],
            'title' =>  ['string', 'max:255'],
            'gender' => ['required', 'string', Rule::in(['Male', 'Female'])],
            'bio' =>  ['required', 'string', 'max:255'],
            'specialization_id' =>  ['required', 'integer', 'max:255'],
            'date_of_birth' => [ 'required', 'date'],
            'phone_number' => ['required', 'numeric', Rule::unique('doctors')->ignore($doctor->id)],
            'photo' => ['image', 'mimes:jpg,png,jpeg', 'max:4048'],
        ];
    }
}
