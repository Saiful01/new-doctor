@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.doctor.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.doctors.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.doctor.fields.id') }}
                        </th>
                        <td>
                            {{ $doctor->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.doctor.fields.name') }}
                        </th>
                        <td>
                            {{ $doctor->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.doctor.fields.phone') }}
                        </th>
                        <td>
                            {{ $doctor->phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.doctor.fields.email') }}
                        </th>
                        <td>
                            {{ $doctor->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.doctor.fields.designation') }}
                        </th>
                        <td>
                            {{ $doctor->designation->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.doctor.fields.gender') }}
                        </th>
                        <td>
                            {{ App\Models\Doctor::GENDER_RADIO[$doctor->gender] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.doctor.fields.specialist') }}
                        </th>
                        <td>
                            @foreach($doctor->specialists as $key => $specialist)
                                <span class="label label-info">{{ $specialist->title }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.doctor.fields.hospital') }}
                        </th>
                        <td>
                            @foreach($doctor->hospitals as $key => $hospital)
                                <span class="label label-info">{{ $hospital->title }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.doctor.fields.day') }}
                        </th>
                        <td>
                            @foreach($doctor->days as $key => $day)
                                <span class="label label-info">{{ $day->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.doctor.fields.address') }}
                        </th>
                        <td>
                            {{ $doctor->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.doctor.fields.short_details') }}
                        </th>
                        <td>
                            {{ $doctor->short_details }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.doctor.fields.overview') }}
                        </th>
                        <td>
                            {!! $doctor->overview !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.doctor.fields.pro_image') }}
                        </th>
                        <td>
                            @if($doctor->pro_image)
                                <a href="{{ $doctor->pro_image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $doctor->pro_image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.doctor.fields.fee') }}
                        </th>
                        <td>
                            {{ $doctor->fee }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.doctor.fields.old_fee') }}
                        </th>
                        <td>
                            {{ $doctor->old_fee }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.doctors.index') }}">
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
            <a class="nav-link" href="#doctor_doctor_serials" role="tab" data-toggle="tab">
                {{ trans('cruds.doctorSerial.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#doctor_appointments" role="tab" data-toggle="tab">
                {{ trans('cruds.appointment.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="doctor_doctor_serials">
            @includeIf('admin.doctors.relationships.doctorDoctorSerials', ['doctorSerials' => $doctor->doctorDoctorSerials])
        </div>
        <div class="tab-pane" role="tabpanel" id="doctor_appointments">
            @includeIf('admin.doctors.relationships.doctorAppointments', ['appointments' => $doctor->doctorAppointments])
        </div>
    </div>
</div>

@endsection