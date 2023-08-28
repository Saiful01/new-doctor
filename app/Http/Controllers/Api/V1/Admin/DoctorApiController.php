<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreDoctorRequest;
use App\Http\Requests\UpdateDoctorRequest;
use App\Http\Resources\Admin\DoctorResource;
use App\Models\Doctor;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DoctorApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('doctor_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DoctorResource(Doctor::with(['designation', 'specialists', 'hospitals', 'days'])->get());
    }

    public function store(StoreDoctorRequest $request)
    {
        $doctor = Doctor::create($request->all());
        $doctor->specialists()->sync($request->input('specialists', []));
        $doctor->hospitals()->sync($request->input('hospitals', []));
        $doctor->days()->sync($request->input('days', []));
        if ($request->input('pro_image', false)) {
            $doctor->addMedia(storage_path('tmp/uploads/' . basename($request->input('pro_image'))))->toMediaCollection('pro_image');
        }

        return (new DoctorResource($doctor))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Doctor $doctor)
    {
        abort_if(Gate::denies('doctor_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DoctorResource($doctor->load(['designation', 'specialists', 'hospitals', 'days']));
    }

    public function update(UpdateDoctorRequest $request, Doctor $doctor)
    {
        $doctor->update($request->all());
        $doctor->specialists()->sync($request->input('specialists', []));
        $doctor->hospitals()->sync($request->input('hospitals', []));
        $doctor->days()->sync($request->input('days', []));
        if ($request->input('pro_image', false)) {
            if (! $doctor->pro_image || $request->input('pro_image') !== $doctor->pro_image->file_name) {
                if ($doctor->pro_image) {
                    $doctor->pro_image->delete();
                }
                $doctor->addMedia(storage_path('tmp/uploads/' . basename($request->input('pro_image'))))->toMediaCollection('pro_image');
            }
        } elseif ($doctor->pro_image) {
            $doctor->pro_image->delete();
        }

        return (new DoctorResource($doctor))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Doctor $doctor)
    {
        abort_if(Gate::denies('doctor_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $doctor->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
