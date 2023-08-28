@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.specialist.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.specialists.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.specialist.fields.id') }}
                        </th>
                        <td>
                            {{ $specialist->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.specialist.fields.title') }}
                        </th>
                        <td>
                            {{ $specialist->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.specialist.fields.is_active') }}
                        </th>
                        <td>
                            {{ App\Models\Specialist::IS_ACTIVE_RADIO[$specialist->is_active] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.specialist.fields.logo') }}
                        </th>
                        <td>
                            @if($specialist->logo)
                                <a href="{{ $specialist->logo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $specialist->logo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.specialists.index') }}">
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
            <a class="nav-link" href="#specialist_doctors" role="tab" data-toggle="tab">
                {{ trans('cruds.doctor.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="specialist_doctors">
            @includeIf('admin.specialists.relationships.specialistDoctors', ['doctors' => $specialist->specialistDoctors])
        </div>
    </div>
</div>

@endsection