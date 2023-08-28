<?php

namespace App\Http\Requests;

use App\Models\Upazila;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateUpazilaRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('upazila_edit');
    }

    public function rules()
    {
        return [
            'district_id' => [
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
            'police_station_name' => [
                'string',
                'nullable',
            ],
            'type' => [
                'string',
                'nullable',
            ],
        ];
    }
}
