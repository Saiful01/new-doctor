<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAppointmentStatusRequest;
use App\Http\Requests\StoreAppointmentStatusRequest;
use App\Http\Requests\UpdateAppointmentStatusRequest;
use App\Models\Appointment;
use App\Models\AppointmentStatus;
use App\Models\Status;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AppointmentStatusController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('appointment_status_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appointmentStatuses = AppointmentStatus::with(['appointment', 'status'])->get();

        return view('admin.appointmentStatuses.index', compact('appointmentStatuses'));
    }

    public function create()
    {
        abort_if(Gate::denies('appointment_status_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appointments = Appointment::pluck('appointment_token', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = Status::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.appointmentStatuses.create', compact('appointments', 'statuses'));
    }

    public function store(StoreAppointmentStatusRequest $request)
    {
        $appointmentStatus = AppointmentStatus::create($request->all());

        return redirect()->route('admin.appointment-statuses.index');
    }

    public function edit(AppointmentStatus $appointmentStatus)
    {
        abort_if(Gate::denies('appointment_status_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appointments = Appointment::pluck('appointment_token', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = Status::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $appointmentStatus->load('appointment', 'status');

        return view('admin.appointmentStatuses.edit', compact('appointmentStatus', 'appointments', 'statuses'));
    }

    public function update(UpdateAppointmentStatusRequest $request, AppointmentStatus $appointmentStatus)
    {
        $appointmentStatus->update($request->all());

        return redirect()->route('admin.appointment-statuses.index');
    }

    public function show(AppointmentStatus $appointmentStatus)
    {
        abort_if(Gate::denies('appointment_status_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appointmentStatus->load('appointment', 'status');

        return view('admin.appointmentStatuses.show', compact('appointmentStatus'));
    }

    public function destroy(AppointmentStatus $appointmentStatus)
    {
        abort_if(Gate::denies('appointment_status_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appointmentStatus->delete();

        return back();
    }

    public function massDestroy(MassDestroyAppointmentStatusRequest $request)
    {
        $appointmentStatuses = AppointmentStatus::find(request('ids'));

        foreach ($appointmentStatuses as $appointmentStatus) {
            $appointmentStatus->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
