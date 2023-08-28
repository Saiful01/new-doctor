@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.appointmentReport.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.appointment-reports.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.appointmentReport.fields.id') }}
                        </th>
                        <td>
                            {{ $appointmentReport->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appointmentReport.fields.appointment') }}
                        </th>
                        <td>
                            {{ $appointmentReport->appointment->appointment_token ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appointmentReport.fields.title') }}
                        </th>
                        <td>
                            {{ $appointmentReport->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appointmentReport.fields.details') }}
                        </th>
                        <td>
                            {!! $appointmentReport->details !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appointmentReport.fields.report') }}
                        </th>
                        <td>
                            @foreach($appointmentReport->report as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.appointment-reports.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection