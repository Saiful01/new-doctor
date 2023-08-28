<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyAppointmentReportRequest;
use App\Http\Requests\StoreAppointmentReportRequest;
use App\Http\Requests\UpdateAppointmentReportRequest;
use App\Models\Appointment;
use App\Models\AppointmentReport;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class AppointmentReportController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('appointment_report_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appointmentReports = AppointmentReport::with(['appointment', 'media'])->get();

        return view('admin.appointmentReports.index', compact('appointmentReports'));
    }

    public function create()
    {
        abort_if(Gate::denies('appointment_report_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appointments = Appointment::pluck('appointment_token', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.appointmentReports.create', compact('appointments'));
    }

    public function store(StoreAppointmentReportRequest $request)
    {
        $appointmentReport = AppointmentReport::create($request->all());

        foreach ($request->input('report', []) as $file) {
            $appointmentReport->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('report');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $appointmentReport->id]);
        }

        return redirect()->route('admin.appointment-reports.index');
    }

    public function edit(AppointmentReport $appointmentReport)
    {
        abort_if(Gate::denies('appointment_report_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appointments = Appointment::pluck('appointment_token', 'id')->prepend(trans('global.pleaseSelect'), '');

        $appointmentReport->load('appointment');

        return view('admin.appointmentReports.edit', compact('appointmentReport', 'appointments'));
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

        return redirect()->route('admin.appointment-reports.index');
    }

    public function show(AppointmentReport $appointmentReport)
    {
        abort_if(Gate::denies('appointment_report_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appointmentReport->load('appointment');

        return view('admin.appointmentReports.show', compact('appointmentReport'));
    }

    public function destroy(AppointmentReport $appointmentReport)
    {
        abort_if(Gate::denies('appointment_report_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appointmentReport->delete();

        return back();
    }

    public function massDestroy(MassDestroyAppointmentReportRequest $request)
    {
        $appointmentReports = AppointmentReport::find(request('ids'));

        foreach ($appointmentReports as $appointmentReport) {
            $appointmentReport->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('appointment_report_create') && Gate::denies('appointment_report_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new AppointmentReport();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
