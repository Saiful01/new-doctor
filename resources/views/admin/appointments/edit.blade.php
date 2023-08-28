@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.appointment.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.appointments.update", [$appointment->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="applicant_id">{{ trans('cruds.appointment.fields.applicant') }}</label>
                <select class="form-control select2 {{ $errors->has('applicant') ? 'is-invalid' : '' }}" name="applicant_id" id="applicant_id" required>
                    @foreach($applicants as $id => $entry)
                        <option value="{{ $id }}" {{ (old('applicant_id') ? old('applicant_id') : $appointment->applicant->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('applicant'))
                    <div class="invalid-feedback">
                        {{ $errors->first('applicant') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.appointment.fields.applicant_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="doctor_id">{{ trans('cruds.appointment.fields.doctor') }}</label>
                <select class="form-control select2 {{ $errors->has('doctor') ? 'is-invalid' : '' }}" name="doctor_id" id="doctor_id" required>
                    @foreach($doctors as $id => $entry)
                        <option value="{{ $id }}" {{ (old('doctor_id') ? old('doctor_id') : $appointment->doctor->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('doctor'))
                    <div class="invalid-feedback">
                        {{ $errors->first('doctor') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.appointment.fields.doctor_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="hospital_id">{{ trans('cruds.appointment.fields.hospital') }}</label>
                <select class="form-control select2 {{ $errors->has('hospital') ? 'is-invalid' : '' }}" name="hospital_id" id="hospital_id" required>
                    @foreach($hospitals as $id => $entry)
                        <option value="{{ $id }}" {{ (old('hospital_id') ? old('hospital_id') : $appointment->hospital->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('hospital'))
                    <div class="invalid-feedback">
                        {{ $errors->first('hospital') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.appointment.fields.hospital_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="guest_patient_id">{{ trans('cruds.appointment.fields.guest_patient') }}</label>
                <select class="form-control select2 {{ $errors->has('guest_patient') ? 'is-invalid' : '' }}" name="guest_patient_id" id="guest_patient_id">
                    @foreach($guest_patients as $id => $entry)
                        <option value="{{ $id }}" {{ (old('guest_patient_id') ? old('guest_patient_id') : $appointment->guest_patient->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('guest_patient'))
                    <div class="invalid-feedback">
                        {{ $errors->first('guest_patient') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.appointment.fields.guest_patient_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="serial_id">{{ trans('cruds.appointment.fields.serial') }}</label>
                <select class="form-control select2 {{ $errors->has('serial') ? 'is-invalid' : '' }}" name="serial_id" id="serial_id" required>
                    @foreach($serials as $id => $entry)
                        <option value="{{ $id }}" {{ (old('serial_id') ? old('serial_id') : $appointment->serial->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('serial'))
                    <div class="invalid-feedback">
                        {{ $errors->first('serial') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.appointment.fields.serial_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.appointment.fields.appoint_type') }}</label>
                <select class="form-control {{ $errors->has('appoint_type') ? 'is-invalid' : '' }}" name="appoint_type" id="appoint_type">
                    <option value disabled {{ old('appoint_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Appointment::APPOINT_TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('appoint_type', $appointment->appoint_type) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('appoint_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('appoint_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.appointment.fields.appoint_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="appointment_token">{{ trans('cruds.appointment.fields.appointment_token') }}</label>
                <input class="form-control {{ $errors->has('appointment_token') ? 'is-invalid' : '' }}" type="text" name="appointment_token" id="appointment_token" value="{{ old('appointment_token', $appointment->appointment_token) }}" required>
                @if($errors->has('appointment_token'))
                    <div class="invalid-feedback">
                        {{ $errors->first('appointment_token') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.appointment.fields.appointment_token_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.appointment.fields.applicant_type') }}</label>
                <select class="form-control {{ $errors->has('applicant_type') ? 'is-invalid' : '' }}" name="applicant_type" id="applicant_type" required>
                    <option value disabled {{ old('applicant_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Appointment::APPLICANT_TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('applicant_type', $appointment->applicant_type) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('applicant_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('applicant_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.appointment.fields.applicant_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="appoint_date">{{ trans('cruds.appointment.fields.appoint_date') }}</label>
                <input class="form-control date {{ $errors->has('appoint_date') ? 'is-invalid' : '' }}" type="text" name="appoint_date" id="appoint_date" value="{{ old('appoint_date', $appointment->appoint_date) }}" required>
                @if($errors->has('appoint_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('appoint_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.appointment.fields.appoint_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="status_id">{{ trans('cruds.appointment.fields.status') }}</label>
                <select class="form-control select2 {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status_id" id="status_id">
                    @foreach($statuses as $id => $entry)
                        <option value="{{ $id }}" {{ (old('status_id') ? old('status_id') : $appointment->status->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.appointment.fields.status_helper') }}</span>
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