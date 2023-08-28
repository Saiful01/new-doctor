@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.doctorSerial.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.doctor-serials.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="doctor_id">{{ trans('cruds.doctorSerial.fields.doctor') }}</label>
                <select class="form-control select2 {{ $errors->has('doctor') ? 'is-invalid' : '' }}" name="doctor_id" id="doctor_id" required>
                    @foreach($doctors as $id => $entry)
                        <option value="{{ $id }}" {{ old('doctor_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('doctor'))
                    <div class="invalid-feedback">
                        {{ $errors->first('doctor') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.doctorSerial.fields.doctor_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="hospital_id">{{ trans('cruds.doctorSerial.fields.hospital') }}</label>
                <select class="form-control select2 {{ $errors->has('hospital') ? 'is-invalid' : '' }}" name="hospital_id" id="hospital_id" required>
                    @foreach($hospitals as $id => $entry)
                        <option value="{{ $id }}" {{ old('hospital_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('hospital'))
                    <div class="invalid-feedback">
                        {{ $errors->first('hospital') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.doctorSerial.fields.hospital_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.doctorSerial.fields.type') }}</label>
                @foreach(App\Models\DoctorSerial::TYPE_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('type') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="type_{{ $key }}" name="type" value="{{ $key }}" {{ old('type', '') === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="type_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.doctorSerial.fields.type_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.doctorSerial.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.doctorSerial.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.doctorSerial.fields.is_book') }}</label>
                @foreach(App\Models\DoctorSerial::IS_BOOK_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('is_book') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="is_book_{{ $key }}" name="is_book" value="{{ $key }}" {{ old('is_book', '0') === (string) $key ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_book_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('is_book'))
                    <div class="invalid-feedback">
                        {{ $errors->first('is_book') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.doctorSerial.fields.is_book_helper') }}</span>
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