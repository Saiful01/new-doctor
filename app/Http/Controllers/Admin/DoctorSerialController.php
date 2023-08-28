<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyDoctorSerialRequest;
use App\Http\Requests\StoreDoctorSerialRequest;
use App\Http\Requests\UpdateDoctorSerialRequest;
use App\Models\Doctor;
use App\Models\DoctorSerial;
use App\Models\Hospital;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DoctorSerialController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('doctor_serial_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $doctorSerials = DoctorSerial::with(['doctor', 'hospital'])->get();

        return view('admin.doctorSerials.index', compact('doctorSerials'));
    }

    public function create()
    {
        abort_if(Gate::denies('doctor_serial_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $doctors = Doctor::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $hospitals = Hospital::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.doctorSerials.create', compact('doctors', 'hospitals'));
    }

    public function store(StoreDoctorSerialRequest $request)
    {
        $doctorSerial = DoctorSerial::create($request->all());

        return redirect()->route('admin.doctor-serials.index');
    }

    public function edit(DoctorSerial $doctorSerial)
    {
        abort_if(Gate::denies('doctor_serial_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $doctors = Doctor::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $hospitals = Hospital::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $doctorSerial->load('doctor', 'hospital');

        return view('admin.doctorSerials.edit', compact('doctorSerial', 'doctors', 'hospitals'));
    }

    public function update(UpdateDoctorSerialRequest $request, DoctorSerial $doctorSerial)
    {
        $doctorSerial->update($request->all());

        return redirect()->route('admin.doctor-serials.index');
    }

    public function show(DoctorSerial $doctorSerial)
    {
        abort_if(Gate::denies('doctor_serial_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $doctorSerial->load('doctor', 'hospital', 'serialAppointments');

        return view('admin.doctorSerials.show', compact('doctorSerial'));
    }

    public function destroy(DoctorSerial $doctorSerial)
    {
        abort_if(Gate::denies('doctor_serial_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $doctorSerial->delete();

        return back();
    }

    public function massDestroy(MassDestroyDoctorSerialRequest $request)
    {
        $doctorSerials = DoctorSerial::find(request('ids'));

        foreach ($doctorSerials as $doctorSerial) {
            $doctorSerial->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
