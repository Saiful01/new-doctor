@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.weeklyDay.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.weekly-days.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.weeklyDay.fields.id') }}
                        </th>
                        <td>
                            {{ $weeklyDay->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.weeklyDay.fields.name') }}
                        </th>
                        <td>
                            {{ $weeklyDay->name }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.weekly-days.index') }}">
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
            <a class="nav-link" href="#day_doctors" role="tab" data-toggle="tab">
                {{ trans('cruds.doctor.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="day_doctors">
            @includeIf('admin.weeklyDays.relationships.dayDoctors', ['doctors' => $weeklyDay->dayDoctors])
        </div>
    </div>
</div>

@endsection