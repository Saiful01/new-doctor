<?php

namespace App\Http\Requests;

use App\Models\DoctorSerial;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateDoctorSerialRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('doctor_serial_edit');
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
                'unique:doctor_serials,title,' . request()->route('doctor_serial')->id,
            ],
        ];
    }
}
