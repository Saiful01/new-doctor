<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDoctorSerialRequest;
use App\Http\Requests\UpdateDoctorSerialRequest;
use App\Http\Resources\Admin\DoctorSerialResource;
use App\Models\DoctorSerial;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DoctorSerialApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('doctor_serial_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DoctorSerialResource(DoctorSerial::with(['doctor', 'hospital'])->get());
    }

    public function store(StoreDoctorSerialRequest $request)
    {
        $doctorSerial = DoctorSerial::create($request->all());

        return (new DoctorSerialResource($doctorSerial))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(DoctorSerial $doctorSerial)
    {
        abort_if(Gate::denies('doctor_serial_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DoctorSerialResource($doctorSerial->load(['doctor', 'hospital']));
    }

    public function update(UpdateDoctorSerialRequest $request, DoctorSerial $doctorSerial)
    {
        $doctorSerial->update($request->all());

        return (new DoctorSerialResource($doctorSerial))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(DoctorSerial $doctorSerial)
    {
        abort_if(Gate::denies('doctor_serial_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $doctorSerial->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
