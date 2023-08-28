<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreSpecialistRequest;
use App\Http\Requests\UpdateSpecialistRequest;
use App\Http\Resources\Admin\SpecialistResource;
use App\Models\Specialist;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SpecialistApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('specialist_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SpecialistResource(Specialist::all());
    }

    public function store(StoreSpecialistRequest $request)
    {
        $specialist = Specialist::create($request->all());

        if ($request->input('logo', false)) {
            $specialist->addMedia(storage_path('tmp/uploads/' . basename($request->input('logo'))))->toMediaCollection('logo');
        }

        return (new SpecialistResource($specialist))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Specialist $specialist)
    {
        abort_if(Gate::denies('specialist_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SpecialistResource($specialist);
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

        return (new SpecialistResource($specialist))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Specialist $specialist)
    {
        abort_if(Gate::denies('specialist_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $specialist->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
