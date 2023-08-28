<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyHospitalRequest;
use App\Http\Requests\StoreHospitalRequest;
use App\Http\Requests\UpdateHospitalRequest;
use App\Models\Hospital;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class HospitalController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('hospital_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hospitals = Hospital::with(['media'])->get();

        return view('admin.hospitals.index', compact('hospitals'));
    }

    public function create()
    {
        abort_if(Gate::denies('hospital_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.hospitals.create');
    }

    public function store(StoreHospitalRequest $request)
    {
        $hospital = Hospital::create($request->all());

        if ($request->input('featured_image', false)) {
            $hospital->addMedia(storage_path('tmp/uploads/' . basename($request->input('featured_image'))))->toMediaCollection('featured_image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $hospital->id]);
        }

        return redirect()->route('admin.hospitals.index');
    }

    public function edit(Hospital $hospital)
    {
        abort_if(Gate::denies('hospital_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.hospitals.edit', compact('hospital'));
    }

    public function update(UpdateHospitalRequest $request, Hospital $hospital)
    {
        $hospital->update($request->all());

        if ($request->input('featured_image', false)) {
            if (! $hospital->featured_image || $request->input('featured_image') !== $hospital->featured_image->file_name) {
                if ($hospital->featured_image) {
                    $hospital->featured_image->delete();
                }
                $hospital->addMedia(storage_path('tmp/uploads/' . basename($request->input('featured_image'))))->toMediaCollection('featured_image');
            }
        } elseif ($hospital->featured_image) {
            $hospital->featured_image->delete();
        }

        return redirect()->route('admin.hospitals.index');
    }

    public function show(Hospital $hospital)
    {
        abort_if(Gate::denies('hospital_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hospital->load('hospitalAppointments', 'hospitalDoctorSerials', 'hospitalDoctors');

        return view('admin.hospitals.show', compact('hospital'));
    }

    public function destroy(Hospital $hospital)
    {
        abort_if(Gate::denies('hospital_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hospital->delete();

        return back();
    }

    public function massDestroy(MassDestroyHospitalRequest $request)
    {
        $hospitals = Hospital::find(request('ids'));

        foreach ($hospitals as $hospital) {
            $hospital->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('hospital_create') && Gate::denies('hospital_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Hospital();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
