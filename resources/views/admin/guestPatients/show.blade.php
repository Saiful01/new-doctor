@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.guestPatient.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.guest-patients.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.guestPatient.fields.id') }}
                        </th>
                        <td>
                            {{ $guestPatient->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.guestPatient.fields.name') }}
                        </th>
                        <td>
                            {{ $guestPatient->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.guestPatient.fields.dob') }}
                        </th>
                        <td>
                            {{ $guestPatient->dob }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.guestPatient.fields.phone') }}
                        </th>
                        <td>
                            {{ $guestPatient->phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.guestPatient.fields.address') }}
                        </th>
                        <td>
                            {{ $guestPatient->address }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.guest-patients.index') }}">
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
            <a class="nav-link" href="#guest_patient_appointments" role="tab" data-toggle="tab">
                {{ trans('cruds.appointment.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="guest_patient_appointments">
            @includeIf('admin.guestPatients.relationships.guestPatientAppointments', ['appointments' => $guestPatient->guestPatientAppointments])
        </div>
    </div>
</div>

@endsection