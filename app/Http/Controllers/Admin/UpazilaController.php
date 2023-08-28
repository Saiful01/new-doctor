<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyUpazilaRequest;
use App\Http\Requests\StoreUpazilaRequest;
use App\Http\Requests\UpdateUpazilaRequest;
use App\Models\District;
use App\Models\Upazila;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UpazilaController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('upazila_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $upazilas = Upazila::with(['district'])->get();

        return view('admin.upazilas.index', compact('upazilas'));
    }

    public function create()
    {
        abort_if(Gate::denies('upazila_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $districts = District::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.upazilas.create', compact('districts'));
    }

    public function store(StoreUpazilaRequest $request)
    {
        $upazila = Upazila::create($request->all());

        return redirect()->route('admin.upazilas.index');
    }

    public function edit(Upazila $upazila)
    {
        abort_if(Gate::denies('upazila_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $districts = District::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $upazila->load('district');

        return view('admin.upazilas.edit', compact('districts', 'upazila'));
    }

    public function update(UpdateUpazilaRequest $request, Upazila $upazila)
    {
        $upazila->update($request->all());

        return redirect()->route('admin.upazilas.index');
    }

    public function show(Upazila $upazila)
    {
        abort_if(Gate::denies('upazila_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $upazila->load('district', 'upazilaApplicants');

        return view('admin.upazilas.show', compact('upazila'));
    }

    public function destroy(Upazila $upazila)
    {
        abort_if(Gate::denies('upazila_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $upazila->delete();

        return back();
    }

    public function massDestroy(MassDestroyUpazilaRequest $request)
    {
        $upazilas = Upazila::find(request('ids'));

        foreach ($upazilas as $upazila) {
            $upazila->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
