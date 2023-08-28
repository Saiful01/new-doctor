<?php

namespace App\Http\Requests;

use App\Models\Specialist;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSpecialistRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('specialist_edit');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'nullable',
            ],
        ];
    }
}
