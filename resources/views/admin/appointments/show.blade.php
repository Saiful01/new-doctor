@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.appointment.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.appointments.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.appointment.fields.id') }}
                        </th>
                        <td>
                            {{ $appointment->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appointment.fields.applicant') }}
                        </th>
                        <td>
                            {{ $appointment->applicant->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appointment.fields.doctor') }}
                        </th>
                        <td>
                            {{ $appointment->doctor->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appointment.fields.hospital') }}
                        </th>
                        <td>
                            {{ $appointment->hospital->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appointment.fields.guest_patient') }}
                        </th>
                        <td>
                            {{ $appointment->guest_patient->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appointment.fields.serial') }}
                        </th>
                        <td>
                            {{ $appointment->serial->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appointment.fields.appoint_type') }}
                        </th>
                        <td>
                            {{ App\Models\Appointment::APPOINT_TYPE_SELECT[$appointment->appoint_type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appointment.fields.appointment_token') }}
                        </th>
                        <td>
                            {{ $appointment->appointment_token }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appointment.fields.applicant_type') }}
                        </th>
                        <td>
                            {{ App\Models\Appointment::APPLICANT_TYPE_SELECT[$appointment->applicant_type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appointment.fields.appoint_date') }}
                        </th>
                        <td>
                            {{ $appointment->appoint_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appointment.fields.status') }}
                        </th>
                        <td>
                            {{ $appointment->status->title ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.appointments.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#appointment_appointment_statuses" role="tab" data-toggle="tab">
                {{ trans('cruds.appointmentStatus.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#appointment_appointment_reports" role="tab" data-toggle="tab">
                {{ trans('cruds.appointmentReport.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="appointment_appointment_statuses">
            @includeIf('admin.appointments.relationships.appointmentAppointmentStatuses', ['appointmentStatuses' => $appointment->appointmentAppointmentStatuses])
        </div>
        <div class="tab-pane" role="tabpanel" id="appointment_appointment_reports">
            @includeIf('admin.appointments.relationships.appointmentAppointmentReports', ['appointmentReports' => $appointment->appointmentAppointmentReports])
        </div>
    </div>
</div>

@endsection