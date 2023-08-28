<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGuestPatientRequest;
use App\Http\Requests\UpdateGuestPatientRequest;
use App\Http\Resources\Admin\GuestPatientResource;
use App\Models\GuestPatient;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GuestPatientApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('guest_patient_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new GuestPatientResource(GuestPatient::all());
    }

    public function store(StoreGuestPatientRequest $request)
    {
        $guestPatient = GuestPatient::create($request->all());

        return (new GuestPatientResource($guestPatient))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(GuestPatient $guestPatient)
    {
        abort_if(Gate::denies('guest_patient_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new GuestPatientResource($guestPatient);
    }

    public function update(UpdateGuestPatientRequest $request, GuestPatient $guestPatient)
    {
        $guestPatient->update($request->all());

        return (new GuestPatientResource($guestPatient))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(GuestPatient $guestPatient)
    {
        abort_if(Gate::denies('guest_patient_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $guestPatient->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
