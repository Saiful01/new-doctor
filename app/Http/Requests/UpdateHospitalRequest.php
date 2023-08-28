<?php

namespace App\Http\Requests;

use App\Models\Hospital;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateHospitalRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('hospital_edit');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
                'unique:hospitals,title,' . request()->route('hospital')->id,
            ],
        ];
    }
}
