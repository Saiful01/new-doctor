<?php

namespace App\Http\Requests;

use App\Models\GuestPatient;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreGuestPatientRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('guest_patient_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'dob' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'phone' => [
                'string',
                'required',
            ],
            'address' => [
                'string',
                'nullable',
            ],
        ];
    }
}
