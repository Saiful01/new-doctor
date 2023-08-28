@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.doctorSerial.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.doctor-serials.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.doctorSerial.fields.id') }}
                        </th>
                        <td>
                            {{ $doctorSerial->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.doctorSerial.fields.doctor') }}
                        </th>
                        <td>
                            {{ $doctorSerial->doctor->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.doctorSerial.fields.hospital') }}
                        </th>
                        <td>
                            {{ $doctorSerial->hospital->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.doctorSerial.fields.type') }}
                        </th>
                        <td>
                            {{ App\Models\DoctorSerial::TYPE_RADIO[$doctorSerial->type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.doctorSerial.fields.title') }}
                        </th>
                        <td>
                            {{ $doctorSerial->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.doctorSerial.fields.is_book') }}
                        </th>
                        <td>
                            {{ App\Models\DoctorSerial::IS_BOOK_RADIO[$doctorSerial->is_book] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.doctor-serials.index') }}">
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
            <a class="nav-link" href="#serial_appointments" role="tab" data-toggle="tab">
                {{ trans('cruds.appointment.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="serial_appointments">
            @includeIf('admin.doctorSerials.relationships.serialAppointments', ['appointments' => $doctorSerial->serialAppointments])
        </div>
    </div>
</div>

@endsection