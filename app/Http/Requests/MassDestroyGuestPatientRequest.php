<?php

namespace App\Http\Requests;

use App\Models\GuestPatient;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyGuestPatientRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('guest_patient_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:guest_patients,id',
        ];
    }
}
