<?php

namespace App\Http\Requests;

use App\Models\Doctor;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreDoctorRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('doctor_create');
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
                'nullable',
            ],
            'designation_id' => [
                'required',
                'integer',
            ],
            'gender' => [
                'required',
            ],
            'specialists.*' => [
                'integer',
            ],
            'specialists' => [
                'required',
                'array',
            ],
            'hospitals.*' => [
                'integer',
            ],
            'hospitals' => [
                'required',
                'array',
            ],
            'days.*' => [
                'integer',
            ],
            'days' => [
                'required',
                'array',
            ],
            'address' => [
                'string',
                'nullable',
            ],
            'pro_image' => [
                'required',
            ],
            'fee' => [
                'required',
            ],
        ];
    }
}
