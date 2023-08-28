<?php

namespace App\Http\Requests;

use App\Models\DoctorSerial;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreDoctorSerialRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('doctor_serial_create');
    }

    public function rules()
    {
        return [
            'doctor_id' => [
                'required',
                'integer',
            ],
            'hospital_id' => [
                'required',
                'integer',
            ],
            'type' => [
                'required',
            ],
            'title' => [
                'string',
                'required',
                'unique:doctor_serials',
            ],
        ];
    }
}
