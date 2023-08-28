<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyPlatformRequest;
use App\Http\Requests\StorePlatformRequest;
use App\Http\Requests\UpdatePlatformRequest;
use App\Models\Platform;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class PlatformController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('platform_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $platforms = Platform::with(['media'])->get();

        return view('admin.platforms.index', compact('platforms'));
    }

    public function create()
    {
        abort_if(Gate::denies('platform_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.platforms.create');
    }

    public function store(StorePlatformRequest $request)
    {
        $platform = Platform::create($request->all());

        if ($request->input('logo', false)) {
            $platform->addMedia(storage_path('tmp/uploads/' . basename($request->input('logo'))))->toMediaCollection('logo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $platform->id]);
        }

        return redirect()->route('admin.platforms.index');
    }

    public function edit(Platform $platform)
    {
        abort_if(Gate::denies('platform_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.platforms.edit', compact('platform'));
    }

    public function update(UpdatePlatformRequest $request, Platform $platform)
    {
        $platform->update($request->all());

        if ($request->input('logo', false)) {
            if (! $platform->logo || $request->input('logo') !== $platform->logo->file_name) {
                if ($platform->logo) {
                    $platform->logo->delete();
                }
                $platform->addMedia(storage_path('tmp/uploads/' . basename($request->input('logo'))))->toMediaCollection('logo');
            }
        } elseif ($platform->logo) {
            $platform->logo->delete();
        }

        return redirect()->route('admin.platforms.index');
    }

    public function show(Platform $platform)
    {
        abort_if(Gate::denies('platform_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.platforms.show', compact('platform'));
    }

    public function destroy(Platform $platform)
    {
        abort_if(Gate::denies('platform_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $platform->delete();

        return back();
    }

    public function massDestroy(MassDestroyPlatformRequest $request)
    {
        $platforms = Platform::find(request('ids'));

        foreach ($platforms as $platform) {
            $platform->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('platform_create') && Gate::denies('platform_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Platform();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
