<?php

namespace App\Http\Requests;

use App\Models\WeeklyDay;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreWeeklyDayRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('weekly_day_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:weekly_days',
            ],
        ];
    }
}
