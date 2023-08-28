@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.upazila.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.upazilas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.upazila.fields.id') }}
                        </th>
                        <td>
                            {{ $upazila->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.upazila.fields.district') }}
                        </th>
                        <td>
                            {{ $upazila->district->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.upazila.fields.name') }}
                        </th>
                        <td>
                            {{ $upazila->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.upazila.fields.bn_name') }}
                        </th>
                        <td>
                            {{ $upazila->bn_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.upazila.fields.url') }}
                        </th>
                        <td>
                            {{ $upazila->url }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.upazila.fields.police_station_name') }}
                        </th>
                        <td>
                            {{ $upazila->police_station_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.upazila.fields.type') }}
                        </th>
                        <td>
                            {{ $upazila->type }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.upazilas.index') }}">
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
            <a class="nav-link" href="#upazila_applicants" role="tab" data-toggle="tab">
                {{ trans('cruds.applicant.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="upazila_applicants">
            @includeIf('admin.upazilas.relationships.upazilaApplicants', ['applicants' => $upazila->upazilaApplicants])
        </div>
    </div>
</div>

@endsection