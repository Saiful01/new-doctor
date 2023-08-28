<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyAppointmentRequest;
use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use App\Models\Applicant;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\DoctorSerial;
use App\Models\GuestPatient;
use App\Models\Hospital;
use App\Models\Status;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AppointmentController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('appointment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appointments = Appointment::with(['applicant', 'doctor', 'hospital', 'guest_patient', 'serial', 'status'])->get();

        $applicants = Applicant::get();

        $doctors = Doctor::get();

        $hospitals = Hospital::get();

        $guest_patients = GuestPatient::get();

        $doctor_serials = DoctorSerial::get();

        $statuses = Status::get();

        return view('admin.appointments.index', compact('applicants', 'appointments', 'doctor_serials', 'doctors', 'guest_patients', 'hospitals', 'statuses'));
    }

    public function create()
    {
        abort_if(Gate::denies('appointment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $applicants = Applicant::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $doctors = Doctor::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $hospitals = Hospital::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $guest_patients = GuestPatient::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $serials = DoctorSerial::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.appointments.create', compact('applicants', 'doctors', 'guest_patients', 'hospitals', 'serials'));
    }

    public function store(StoreAppointmentRequest $request)
    {
        $appointment = Appointment::create($request->all());

        return redirect()->route('admin.appointments.index');
    }

    public function edit(Appointment $appointment)
    {
        abort_if(Gate::denies('appointment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $applicants = Applicant::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $doctors = Doctor::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $hospitals = Hospital::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $guest_patients = GuestPatient::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $serials = DoctorSerial::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = Status::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $appointment->load('applicant', 'doctor', 'hospital', 'guest_patient', 'serial', 'status');

        return view('admin.appointments.edit', compact('applicants', 'appointment', 'doctors', 'guest_patients', 'hospitals', 'serials', 'statuses'));
    }

    public function update(UpdateAppointmentRequest $request, Appointment $appointment)
    {
        $appointment->update($request->all());

        return redirect()->route('admin.appointments.index');
    }

    public function show(Appointment $appointment)
    {
        abort_if(Gate::denies('appointment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appointment->load('applicant', 'doctor', 'hospital', 'guest_patient', 'serial', 'status', 'appointmentAppointmentStatuses', 'appointmentAppointmentReports');

        return view('admin.appointments.show', compact('appointment'));
    }

    public function destroy(Appointment $appointment)
    {
        abort_if(Gate::denies('appointment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appointment->delete();

        return back();
    }

    public function massDestroy(MassDestroyAppointmentRequest $request)
    {
        $appointments = Appointment::find(request('ids'));

        foreach ($appointments as $appointment) {
            $appointment->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
