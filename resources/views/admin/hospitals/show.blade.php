@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.hospital.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.hospitals.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.hospital.fields.id') }}
                        </th>
                        <td>
                            {{ $hospital->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hospital.fields.title') }}
                        </th>
                        <td>
                            {{ $hospital->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hospital.fields.address') }}
                        </th>
                        <td>
                            {{ $hospital->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hospital.fields.details') }}
                        </th>
                        <td>
                            {!! $hospital->details !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hospital.fields.featured_image') }}
                        </th>
                        <td>
                            @if($hospital->featured_image)
                                <a href="{{ $hospital->featured_image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $hospital->featured_image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.hospitals.index') }}">
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
            <a class="nav-link" href="#hospital_appointments" role="tab" data-toggle="tab">
                {{ trans('cruds.appointment.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#hospital_doctor_serials" role="tab" data-toggle="tab">
                {{ trans('cruds.doctorSerial.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#hospital_doctors" role="tab" data-toggle="tab">
                {{ trans('cruds.doctor.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="hospital_appointments">
            @includeIf('admin.hospitals.relationships.hospitalAppointments', ['appointments' => $hospital->hospitalAppointments])
        </div>
        <div class="tab-pane" role="tabpanel" id="hospital_doctor_serials">
            @includeIf('admin.hospitals.relationships.hospitalDoctorSerials', ['doctorSerials' => $hospital->hospitalDoctorSerials])
        </div>
        <div class="tab-pane" role="tabpanel" id="hospital_doctors">
            @includeIf('admin.hospitals.relationships.hospitalDoctors', ['doctors' => $hospital->hospitalDoctors])
        </div>
    </div>
</div>

@endsection