<?php

namespace App\Http\Requests;

use App\Models\District;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreDistrictRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('district_create');
    }

    public function rules()
    {
        return [
            'division_id' => [
                'required',
                'integer',
            ],
            'name' => [
                'string',
                'required',
            ],
            'bn_name' => [
                'string',
                'nullable',
            ],
            'url' => [
                'string',
                'nullable',
            ],
            'lat' => [
                'string',
                'nullable',
            ],
            'lon' => [
                'string',
                'nullable',
            ],
        ];
    }
}
