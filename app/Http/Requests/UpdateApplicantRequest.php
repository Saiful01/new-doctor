<?php

namespace App\Http\Requests;

use App\Models\Applicant;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateApplicantRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('applicant_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'phone' => [
                'string',
                'min:10',
                'max:11',
                'required',
                'unique:applicants,phone,' . request()->route('applicant')->id,
            ],
            'blood_group' => [
                'required',
            ],
            'gender' => [
                'required',
            ],
            'age' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'dob' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
        ];
    }
}
