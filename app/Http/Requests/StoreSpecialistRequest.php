<?php

namespace App\Http\Requests;

use App\Models\Specialist;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSpecialistRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('specialist_create');
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
