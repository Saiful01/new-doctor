@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.applicant.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.applicants.update", [$applicant->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.applicant.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $applicant->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.applicant.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="phone">{{ trans('cruds.applicant.fields.phone') }}</label>
                <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', $applicant->phone) }}" required>
                @if($errors->has('phone'))
                    <div class="invalid-feedback">
                        {{ $errors->first('phone') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.applicant.fields.phone_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="email">{{ trans('cruds.applicant.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email', $applicant->email) }}">
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.applicant.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.applicant.fields.blood_group') }}</label>
                <select class="form-control {{ $errors->has('blood_group') ? 'is-invalid' : '' }}" name="blood_group" id="blood_group" required>
                    <option value disabled {{ old('blood_group', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Applicant::BLOOD_GROUP_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('blood_group', $applicant->blood_group) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('blood_group'))
                    <div class="invalid-feedback">
                        {{ $errors->first('blood_group') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.applicant.fields.blood_group_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.applicant.fields.gender') }}</label>
                @foreach(App\Models\Applicant::GENDER_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('gender') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="gender_{{ $key }}" name="gender" value="{{ $key }}" {{ old('gender', $applicant->gender) === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="gender_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('gender'))
                    <div class="invalid-feedback">
                        {{ $errors->first('gender') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.applicant.fields.gender_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="division_id">{{ trans('cruds.applicant.fields.division') }}</label>
                <select class="form-control select2 {{ $errors->has('division') ? 'is-invalid' : '' }}" name="division_id" id="division_id">
                    @foreach($divisions as $id => $entry)
                        <option value="{{ $id }}" {{ (old('division_id') ? old('division_id') : $applicant->division->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('division'))
                    <div class="invalid-feedback">
                        {{ $errors->first('division') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.applicant.fields.division_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="district_id">{{ trans('cruds.applicant.fields.district') }}</label>
                <select class="form-control select2 {{ $errors->has('district') ? 'is-invalid' : '' }}" name="district_id" id="district_id">
                    @foreach($districts as $id => $entry)
                        <option value="{{ $id }}" {{ (old('district_id') ? old('district_id') : $applicant->district->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('district'))
                    <div class="invalid-feedback">
                        {{ $errors->first('district') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.applicant.fields.district_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="upazila_id">{{ trans('cruds.applicant.fields.upazila') }}</label>
                <select class="form-control select2 {{ $errors->has('upazila') ? 'is-invalid' : '' }}" name="upazila_id" id="upazila_id">
                    @foreach($upazilas as $id => $entry)
                        <option value="{{ $id }}" {{ (old('upazila_id') ? old('upazila_id') : $applicant->upazila->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('upazila'))
                    <div class="invalid-feedback">
                        {{ $errors->first('upazila') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.applicant.fields.upazila_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="address">{{ trans('cruds.applicant.fields.address') }}</label>
                <textarea class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" name="address" id="address">{{ old('address', $applicant->address) }}</textarea>
                @if($errors->has('address'))
                    <div class="invalid-feedback">
                        {{ $errors->first('address') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.applicant.fields.address_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="age">{{ trans('cruds.applicant.fields.age') }}</label>
                <input class="form-control {{ $errors->has('age') ? 'is-invalid' : '' }}" type="number" name="age" id="age" value="{{ old('age', $applicant->age) }}" step="1" required>
                @if($errors->has('age'))
                    <div class="invalid-feedback">
                        {{ $errors->first('age') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.applicant.fields.age_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="dob">{{ trans('cruds.applicant.fields.dob') }}</label>
                <input class="form-control date {{ $errors->has('dob') ? 'is-invalid' : '' }}" type="text" name="dob" id="dob" value="{{ old('dob', $applicant->dob) }}">
                @if($errors->has('dob'))
                    <div class="invalid-feedback">
                        {{ $errors->first('dob') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.applicant.fields.dob_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="password">{{ trans('cruds.applicant.fields.password') }}</label>
                <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password" name="password" id="password">
                @if($errors->has('password'))
                    <div class="invalid-feedback">
                        {{ $errors->first('password') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.applicant.fields.password_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.applicant.fields.is_active') }}</label>
                @foreach(App\Models\Applicant::IS_ACTIVE_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('is_active') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="is_active_{{ $key }}" name="is_active" value="{{ $key }}" {{ old('is_active', $applicant->is_active) === (string) $key ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('is_active'))
                    <div class="invalid-feedback">
                        {{ $errors->first('is_active') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.applicant.fields.is_active_helper') }}</span>
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