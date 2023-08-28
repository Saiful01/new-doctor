<?php

namespace App\Http\Requests;

use App\Models\AppointmentStatus;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateAppointmentStatusRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('appointment_status_edit');
    }

    public function rules()
    {
        return [
            'appointment_id' => [
                'required',
                'integer',
            ],
            'status_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
