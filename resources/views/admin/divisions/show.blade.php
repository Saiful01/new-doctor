@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.division.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.divisions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.division.fields.id') }}
                        </th>
                        <td>
                            {{ $division->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.division.fields.name') }}
                        </th>
                        <td>
                            {{ $division->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.division.fields.bn_name') }}
                        </th>
                        <td>
                            {{ $division->bn_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.division.fields.url') }}
                        </th>
                        <td>
                            {{ $division->url }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.divisions.index') }}">
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
            <a class="nav-link" href="#division_districts" role="tab" data-toggle="tab">
                {{ trans('cruds.district.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#division_applicants" role="tab" data-toggle="tab">
                {{ trans('cruds.applicant.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="division_districts">
            @includeIf('admin.divisions.relationships.divisionDistricts', ['districts' => $division->divisionDistricts])
        </div>
        <div class="tab-pane" role="tabpanel" id="division_applicants">
            @includeIf('admin.divisions.relationships.divisionApplicants', ['applicants' => $division->divisionApplicants])
        </div>
    </div>
</div>

@endsection