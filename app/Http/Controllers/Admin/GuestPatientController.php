<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyGuestPatientRequest;
use App\Http\Requests\StoreGuestPatientRequest;
use App\Http\Requests\UpdateGuestPatientRequest;
use App\Models\GuestPatient;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GuestPatientController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('guest_patient_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $guestPatients = GuestPatient::all();

        return view('admin.guestPatients.index', compact('guestPatients'));
    }

    public function create()
    {
        abort_if(Gate::denies('guest_patient_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.guestPatients.create');
    }

    public function store(StoreGuestPatientRequest $request)
    {
        $guestPatient = GuestPatient::create($request->all());

        return redirect()->route('admin.guest-patients.index');
    }

    public function edit(GuestPatient $guestPatient)
    {
        abort_if(Gate::denies('guest_patient_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.guestPatients.edit', compact('guestPatient'));
    }

    public function update(UpdateGuestPatientRequest $request, GuestPatient $guestPatient)
    {
        $guestPatient->update($request->all());

        return redirect()->route('admin.guest-patients.index');
    }

    public function show(GuestPatient $guestPatient)
    {
        abort_if(Gate::denies('guest_patient_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $guestPatient->load('guestPatientAppointments');

        return view('admin.guestPatients.show', compact('guestPatient'));
    }

    public function destroy(GuestPatient $guestPatient)
    {
        abort_if(Gate::denies('guest_patient_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $guestPatient->delete();

        return back();
    }

    public function massDestroy(MassDestroyGuestPatientRequest $request)
    {
        $guestPatients = GuestPatient::find(request('ids'));

        foreach ($guestPatients as $guestPatient) {
            $guestPatient->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
