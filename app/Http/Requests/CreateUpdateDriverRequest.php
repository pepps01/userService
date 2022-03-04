<?php

namespace App\Http\Requests;

use App\Models\Doctor;
use App\Models\Driver;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class CreateUpdateDriverRequest extends FormRequest
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
        $driver = Driver::where('user_id', auth()->user()->id)->first();

        return [
            'firstname' =>  ['required', 'string', 'max:255'],
            'lastname' =>  ['required', 'string', 'max:255'],
            'date_of_birth' => [ 'required', 'date'],
            'phone_number' => ['required', 'numeric', Rule::unique('drivers')->ignore($driver->id)],
            'photo' => ['image', 'mimes:jpg,png,jpeg', 'max:4048'],
            'address' =>  ['required', 'string', 'max:255'],
            'ambulance_service_name' =>  ['required', 'string', 'max:255'],
            
            'country_id' =>  ['required', 'integer'],
            'state_id' =>  ['required', 'integer'],
            'longitude' =>  ['required', 'numeric', 'between:-180,180'],
            'latitude' =>  ['required', 'numeric', 'between:-90,90'],
            'gender' => ['required', 'string', Rule::in(['Male', 'Female'])],
        ];
    }
}
