@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.appointmentStatus.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.appointment-statuses.update", [$appointmentStatus->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="appointment_id">{{ trans('cruds.appointmentStatus.fields.appointment') }}</label>
                <select class="form-control select2 {{ $errors->has('appointment') ? 'is-invalid' : '' }}" name="appointment_id" id="appointment_id" required>
                    @foreach($appointments as $id => $entry)
                        <option value="{{ $id }}" {{ (old('appointment_id') ? old('appointment_id') : $appointmentStatus->appointment->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('appointment'))
                    <div class="invalid-feedback">
                        {{ $errors->first('appointment') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.appointmentStatus.fields.appointment_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="status_id">{{ trans('cruds.appointmentStatus.fields.status') }}</label>
                <select class="form-control select2 {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status_id" id="status_id" required>
                    @foreach($statuses as $id => $entry)
                        <option value="{{ $id }}" {{ (old('status_id') ? old('status_id') : $appointmentStatus->status->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.appointmentStatus.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection