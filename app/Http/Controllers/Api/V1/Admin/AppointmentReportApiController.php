<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreAppointmentReportRequest;
use App\Http\Requests\UpdateAppointmentReportRequest;
use App\Http\Resources\Admin\AppointmentReportResource;
use App\Models\AppointmentReport;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AppointmentReportApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('appointment_report_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AppointmentReportResource(AppointmentReport::with(['appointment'])->get());
    }

    public function store(StoreAppointmentReportRequest $request)
    {
        $appointmentReport = AppointmentReport::create($request->all());

        foreach ($request->input('report', []) as $file) {
            $appointmentReport->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('report');
        }

        return (new AppointmentReportResource($appointmentReport))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(AppointmentReport $appointmentReport)
    {
        abort_if(Gate::denies('appointment_report_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AppointmentReportResource($appointmentReport->load(['appointment']));
    }

    public function update(UpdateAppointmentReportRequest $request, AppointmentReport $appointmentReport)
    {
        $appointmentReport->update($request->all());

        if (count($appointmentReport->report) > 0) {
            foreach ($appointmentReport->report as $media) {
                if (! in_array($media->file_name, $request->input('report', []))) {
                    $media->delete();
                }
            }
        }
        $media = $appointmentReport->report->pluck('file_name')->toArray();
        foreach ($request->input('report', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $appointmentReport->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('report');
            }
        }

        return (new AppointmentReportResource($appointmentReport))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(AppointmentReport $appointmentReport)
    {
        abort_if(Gate::denies('appointment_report_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appointmentReport->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
