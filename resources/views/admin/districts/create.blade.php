@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.district.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.districts.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="division_id">{{ trans('cruds.district.fields.division') }}</label>
                <select class="form-control select2 {{ $errors->has('division') ? 'is-invalid' : '' }}" name="division_id" id="division_id" required>
                    @foreach($divisions as $id => $entry)
                        <option value="{{ $id }}" {{ old('division_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('division'))
                    <div class="invalid-feedback">
                        {{ $errors->first('division') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.district.fields.division_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.district.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.district.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="bn_name">{{ trans('cruds.district.fields.bn_name') }}</label>
                <input class="form-control {{ $errors->has('bn_name') ? 'is-invalid' : '' }}" type="text" name="bn_name" id="bn_name" value="{{ old('bn_name', '') }}">
                @if($errors->has('bn_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('bn_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.district.fields.bn_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="url">{{ trans('cruds.district.fields.url') }}</label>
                <input class="form-control {{ $errors->has('url') ? 'is-invalid' : '' }}" type="text" name="url" id="url" value="{{ old('url', '') }}">
                @if($errors->has('url'))
                    <div class="invalid-feedback">
                        {{ $errors->first('url') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.district.fields.url_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="lat">{{ trans('cruds.district.fields.lat') }}</label>
                <input class="form-control {{ $errors->has('lat') ? 'is-invalid' : '' }}" type="text" name="lat" id="lat" value="{{ old('lat', '') }}">
                @if($errors->has('lat'))
                    <div class="invalid-feedback">
                        {{ $errors->first('lat') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.district.fields.lat_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="lon">{{ trans('cruds.district.fields.lon') }}</label>
                <input class="form-control {{ $errors->has('lon') ? 'is-invalid' : '' }}" type="text" name="lon" id="lon" value="{{ old('lon', '') }}">
                @if($errors->has('lon'))
                    <div class="invalid-feedback">
                        {{ $errors->first('lon') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.district.fields.lon_helper') }}</span>
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