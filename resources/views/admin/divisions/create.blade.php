@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.division.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.divisions.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.division.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.division.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="bn_name">{{ trans('cruds.division.fields.bn_name') }}</label>
                <input class="form-control {{ $errors->has('bn_name') ? 'is-invalid' : '' }}" type="text" name="bn_name" id="bn_name" value="{{ old('bn_name', '') }}">
                @if($errors->has('bn_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('bn_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.division.fields.bn_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="url">{{ trans('cruds.division.fields.url') }}</label>
                <input class="form-control {{ $errors->has('url') ? 'is-invalid' : '' }}" type="text" name="url" id="url" value="{{ old('url', '') }}">
                @if($errors->has('url'))
                    <div class="invalid-feedback">
                        {{ $errors->first('url') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.division.fields.url_helper') }}</span>
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