<?php

namespace App\Http\Requests;

use App\Models\Platform;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePlatformRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('platform_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
            ],
            'phone' => [
                'string',
                'required',
            ],
            'extra_phone' => [
                'string',
                'nullable',
            ],
            'email' => [
                'required',
            ],
            'address' => [
                'required',
            ],
            'logo' => [
                'required',
            ],
            'facebook_url' => [
                'string',
                'nullable',
            ],
            'youtube_url' => [
                'string',
                'nullable',
            ],
            'twiter_url' => [
                'string',
                'nullable',
            ],
            'linked_in_url' => [
                'string',
                'nullable',
            ],
        ];
    }
}
