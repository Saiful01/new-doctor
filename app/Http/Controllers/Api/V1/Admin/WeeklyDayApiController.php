<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWeeklyDayRequest;
use App\Http\Requests\UpdateWeeklyDayRequest;
use App\Http\Resources\Admin\WeeklyDayResource;
use App\Models\WeeklyDay;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WeeklyDayApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('weekly_day_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new WeeklyDayResource(WeeklyDay::all());
    }

    public function store(StoreWeeklyDayRequest $request)
    {
        $weeklyDay = WeeklyDay::create($request->all());

        return (new WeeklyDayResource($weeklyDay))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(WeeklyDay $weeklyDay)
    {
        abort_if(Gate::denies('weekly_day_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new WeeklyDayResource($weeklyDay);
    }

    public function update(UpdateWeeklyDayRequest $request, WeeklyDay $weeklyDay)
    {
        $weeklyDay->update($request->all());

        return (new WeeklyDayResource($weeklyDay))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(WeeklyDay $weeklyDay)
    {
        abort_if(Gate::denies('weekly_day_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $weeklyDay->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
