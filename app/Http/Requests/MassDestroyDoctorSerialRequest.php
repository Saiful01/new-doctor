<?php

namespace App\Http\Requests;

use App\Models\DoctorSerial;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyDoctorSerialRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('doctor_serial_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:doctor_serials,id',
        ];
    }
}
