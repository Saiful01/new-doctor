<?php

namespace App\Http\Requests;

use App\Models\Applicant;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyApplicantRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('applicant_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:applicants,id',
        ];
    }
}
