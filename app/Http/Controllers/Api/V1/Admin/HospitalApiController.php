<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreHospitalRequest;
use App\Http\Requests\UpdateHospitalRequest;
use App\Http\Resources\Admin\HospitalResource;
use App\Models\Hospital;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HospitalApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('hospital_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new HospitalResource(Hospital::all());
    }

    public function store(StoreHospitalRequest $request)
    {
        $hospital = Hospital::create($request->all());

        if ($request->input('featured_image', false)) {
            $hospital->addMedia(storage_path('tmp/uploads/' . basename($request->input('featured_image'))))->toMediaCollection('featured_image');
        }

        return (new HospitalResource($hospital))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Hospital $hospital)
    {
        abort_if(Gate::denies('hospital_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new HospitalResource($hospital);
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

        return (new HospitalResource($hospital))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Hospital $hospital)
    {
        abort_if(Gate::denies('hospital_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hospital->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
