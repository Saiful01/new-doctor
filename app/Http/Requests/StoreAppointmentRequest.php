<?php

namespace App\Http\Requests;

use App\Models\Appointment;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreAppointmentRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('appointment_create');
    }

    public function rules()
    {
        return [
            'applicant_id' => [
                'required',
                'integer',
            ],
            'doctor_id' => [
                'required',
                'integer',
            ],
            'hospital_id' => [
                'required',
                'integer',
            ],
            'serial_id' => [
                'required',
                'integer',
            ],
            'appointment_token' => [
                'string',
                'required',
                'unique:appointments',
            ],
            'applicant_type' => [
                'required',
            ],
            'appoint_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
        ];
    }
}
