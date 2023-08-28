<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyDoctorRequest;
use App\Http\Requests\StoreDoctorRequest;
use App\Http\Requests\UpdateDoctorRequest;
use App\Models\Designation;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Specialist;
use App\Models\WeeklyDay;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class DoctorController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('doctor_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $doctors = Doctor::with(['designation', 'specialists', 'hospitals', 'days', 'media'])->get();

        return view('admin.doctors.index', compact('doctors'));
    }

    public function create()
    {
        abort_if(Gate::denies('doctor_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $designations = Designation::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $specialists = Specialist::pluck('title', 'id');

        $hospitals = Hospital::pluck('title', 'id');

        $days = WeeklyDay::pluck('name', 'id');

        return view('admin.doctors.create', compact('days', 'designations', 'hospitals', 'specialists'));
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

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $doctor->id]);
        }

        return redirect()->route('admin.doctors.index');
    }

    public function edit(Doctor $doctor)
    {
        abort_if(Gate::denies('doctor_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $designations = Designation::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $specialists = Specialist::pluck('title', 'id');

        $hospitals = Hospital::pluck('title', 'id');

        $days = WeeklyDay::pluck('name', 'id');

        $doctor->load('designation', 'specialists', 'hospitals', 'days');

        return view('admin.doctors.edit', compact('days', 'designations', 'doctor', 'hospitals', 'specialists'));
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

        return redirect()->route('admin.doctors.index');
    }

    public function show(Doctor $doctor)
    {
        abort_if(Gate::denies('doctor_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $doctor->load('designation', 'specialists', 'hospitals', 'days', 'doctorDoctorSerials', 'doctorAppointments');

        return view('admin.doctors.show', compact('doctor'));
    }

    public function destroy(Doctor $doctor)
    {
        abort_if(Gate::denies('doctor_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $doctor->delete();

        return back();
    }

    public function massDestroy(MassDestroyDoctorRequest $request)
    {
        $doctors = Doctor::find(request('ids'));

        foreach ($doctors as $doctor) {
            $doctor->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('doctor_create') && Gate::denies('doctor_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Doctor();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
