@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.applicant.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.applicants.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.applicant.fields.id') }}
                        </th>
                        <td>
                            {{ $applicant->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.applicant.fields.name') }}
                        </th>
                        <td>
                            {{ $applicant->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.applicant.fields.phone') }}
                        </th>
                        <td>
                            {{ $applicant->phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.applicant.fields.email') }}
                        </th>
                        <td>
                            {{ $applicant->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.applicant.fields.blood_group') }}
                        </th>
                        <td>
                            {{ App\Models\Applicant::BLOOD_GROUP_SELECT[$applicant->blood_group] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.applicant.fields.gender') }}
                        </th>
                        <td>
                            {{ App\Models\Applicant::GENDER_RADIO[$applicant->gender] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.applicant.fields.division') }}
                        </th>
                        <td>
                            {{ $applicant->division->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.applicant.fields.district') }}
                        </th>
                        <td>
                            {{ $applicant->district->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.applicant.fields.upazila') }}
                        </th>
                        <td>
                            {{ $applicant->upazila->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.applicant.fields.address') }}
                        </th>
                        <td>
                            {{ $applicant->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.applicant.fields.age') }}
                        </th>
                        <td>
                            {{ $applicant->age }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.applicant.fields.dob') }}
                        </th>
                        <td>
                            {{ $applicant->dob }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.applicant.fields.password') }}
                        </th>
                        <td>
                            ********
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.applicant.fields.is_active') }}
                        </th>
                        <td>
                            {{ App\Models\Applicant::IS_ACTIVE_RADIO[$applicant->is_active] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.applicants.index') }}">
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
            <a class="nav-link" href="#applicant_appointments" role="tab" data-toggle="tab">
                {{ trans('cruds.appointment.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="applicant_appointments">
            @includeIf('admin.applicants.relationships.applicantAppointments', ['appointments' => $applicant->applicantAppointments])
        </div>
    </div>
</div>

@endsection