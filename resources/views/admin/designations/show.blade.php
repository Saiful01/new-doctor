@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.designation.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.designations.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.designation.fields.id') }}
                        </th>
                        <td>
                            {{ $designation->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.designation.fields.title') }}
                        </th>
                        <td>
                            {{ $designation->title }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.designations.index') }}">
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
            <a class="nav-link" href="#designation_doctors" role="tab" data-toggle="tab">
                {{ trans('cruds.doctor.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="designation_doctors">
            @includeIf('admin.designations.relationships.designationDoctors', ['doctors' => $designation->designationDoctors])
        </div>
    </div>
</div>

@endsection