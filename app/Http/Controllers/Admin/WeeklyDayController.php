<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyWeeklyDayRequest;
use App\Http\Requests\StoreWeeklyDayRequest;
use App\Http\Requests\UpdateWeeklyDayRequest;
use App\Models\WeeklyDay;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WeeklyDayController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('weekly_day_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $weeklyDays = WeeklyDay::all();

        return view('admin.weeklyDays.index', compact('weeklyDays'));
    }

    public function create()
    {
        abort_if(Gate::denies('weekly_day_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.weeklyDays.create');
    }

    public function store(StoreWeeklyDayRequest $request)
    {
        $weeklyDay = WeeklyDay::create($request->all());

        return redirect()->route('admin.weekly-days.index');
    }

    public function edit(WeeklyDay $weeklyDay)
    {
        abort_if(Gate::denies('weekly_day_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.weeklyDays.edit', compact('weeklyDay'));
    }

    public function update(UpdateWeeklyDayRequest $request, WeeklyDay $weeklyDay)
    {
        $weeklyDay->update($request->all());

        return redirect()->route('admin.weekly-days.index');
    }

    public function show(WeeklyDay $weeklyDay)
    {
        abort_if(Gate::denies('weekly_day_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $weeklyDay->load('dayDoctors');

        return view('admin.weeklyDays.show', compact('weeklyDay'));
    }

    public function destroy(WeeklyDay $weeklyDay)
    {
        abort_if(Gate::denies('weekly_day_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $weeklyDay->delete();

        return back();
    }

    public function massDestroy(MassDestroyWeeklyDayRequest $request)
    {
        $weeklyDays = WeeklyDay::find(request('ids'));

        foreach ($weeklyDays as $weeklyDay) {
            $weeklyDay->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
