<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroySpecialistRequest;
use App\Http\Requests\StoreSpecialistRequest;
use App\Http\Requests\UpdateSpecialistRequest;
use App\Models\Specialist;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class SpecialistController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('specialist_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $specialists = Specialist::with(['media'])->get();

        return view('admin.specialists.index', compact('specialists'));
    }

    public function create()
    {
        abort_if(Gate::denies('specialist_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.specialists.create');
    }

    public function store(StoreSpecialistRequest $request)
    {
        $specialist = Specialist::create($request->all());

        if ($request->input('logo', false)) {
            $specialist->addMedia(storage_path('tmp/uploads/' . basename($request->input('logo'))))->toMediaCollection('logo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $specialist->id]);
        }

        return redirect()->route('admin.specialists.index');
    }

    public function edit(Specialist $specialist)
    {
        abort_if(Gate::denies('specialist_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.specialists.edit', compact('specialist'));
    }

    public function update(UpdateSpecialistRequest $request, Specialist $specialist)
    {
        $specialist->update($request->all());

        if ($request->input('logo', false)) {
            if (! $specialist->logo || $request->input('logo') !== $specialist->logo->file_name) {
                if ($specialist->logo) {
                    $specialist->logo->delete();
                }
                $specialist->addMedia(storage_path('tmp/uploads/' . basename($request->input('logo'))))->toMediaCollection('logo');
            }
        } elseif ($specialist->logo) {
            $specialist->logo->delete();
        }

        return redirect()->route('admin.specialists.index');
    }

    public function show(Specialist $specialist)
    {
        abort_if(Gate::denies('specialist_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $specialist->load('specialistDoctors');

        return view('admin.specialists.show', compact('specialist'));
    }

    public function destroy(Specialist $specialist)
    {
        abort_if(Gate::denies('specialist_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $specialist->delete();

        return back();
    }

    public function massDestroy(MassDestroySpecialistRequest $request)
    {
        $specialists = Specialist::find(request('ids'));

        foreach ($specialists as $specialist) {
            $specialist->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('specialist_create') && Gate::denies('specialist_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Specialist();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
