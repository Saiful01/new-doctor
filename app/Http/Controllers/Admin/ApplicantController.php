<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyApplicantRequest;
use App\Http\Requests\StoreApplicantRequest;
use App\Http\Requests\UpdateApplicantRequest;
use App\Models\Applicant;
use App\Models\District;
use App\Models\Division;
use App\Models\Upazila;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApplicantController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('applicant_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $applicants = Applicant::with(['division', 'district', 'upazila'])->get();

        $divisions = Division::get();

        $districts = District::get();

        $upazilas = Upazila::get();

        return view('admin.applicants.index', compact('applicants', 'districts', 'divisions', 'upazilas'));
    }

    public function create()
    {
        abort_if(Gate::denies('applicant_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $divisions = Division::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $districts = District::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $upazilas = Upazila::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.applicants.create', compact('districts', 'divisions', 'upazilas'));
    }

    public function store(StoreApplicantRequest $request)
    {
        $applicant = Applicant::create($request->all());

        return redirect()->route('admin.applicants.index');
    }

    public function edit(Applicant $applicant)
    {
        abort_if(Gate::denies('applicant_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $divisions = Division::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $districts = District::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $upazilas = Upazila::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $applicant->load('division', 'district', 'upazila');

        return view('admin.applicants.edit', compact('applicant', 'districts', 'divisions', 'upazilas'));
    }

    public function update(UpdateApplicantRequest $request, Applicant $applicant)
    {
        $applicant->update($request->all());

        return redirect()->route('admin.applicants.index');
    }

    public function show(Applicant $applicant)
    {
        abort_if(Gate::denies('applicant_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $applicant->load('division', 'district', 'upazila', 'applicantAppointments');

        return view('admin.applicants.show', compact('applicant'));
    }

    public function destroy(Applicant $applicant)
    {
        abort_if(Gate::denies('applicant_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $applicant->delete();

        return back();
    }

    public function massDestroy(MassDestroyApplicantRequest $request)
    {
        $applicants = Applicant::find(request('ids'));

        foreach ($applicants as $applicant) {
            $applicant->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
