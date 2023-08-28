<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTodaysAppointmentRequest;
use App\Http\Requests\StoreTodaysAppointmentRequest;
use App\Http\Requests\UpdateTodaysAppointmentRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TodaysAppointmentController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('todays_appointment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.todaysAppointments.index');
    }

    public function create()
    {
        abort_if(Gate::denies('todays_appointment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.todaysAppointments.create');
    }

    public function store(StoreTodaysAppointmentRequest $request)
    {
        $todaysAppointment = TodaysAppointment::create($request->all());

        return redirect()->route('admin.todays-appointments.index');
    }

    public function edit(TodaysAppointment $todaysAppointment)
    {
        abort_if(Gate::denies('todays_appointment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.todaysAppointments.edit', compact('todaysAppointment'));
    }

    public function update(UpdateTodaysAppointmentRequest $request, TodaysAppointment $todaysAppointment)
    {
        $todaysAppointment->update($request->all());

        return redirect()->route('admin.todays-appointments.index');
    }

    public function show(TodaysAppointment $todaysAppointment)
    {
        abort_if(Gate::denies('todays_appointment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.todaysAppointments.show', compact('todaysAppointment'));
    }

    public function destroy(TodaysAppointment $todaysAppointment)
    {
        abort_if(Gate::denies('todays_appointment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $todaysAppointment->delete();

        return back();
    }

    public function massDestroy(MassDestroyTodaysAppointmentRequest $request)
    {
        $todaysAppointments = TodaysAppointment::find(request('ids'));

        foreach ($todaysAppointments as $todaysAppointment) {
            $todaysAppointment->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
