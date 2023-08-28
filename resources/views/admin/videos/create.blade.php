@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.video.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.videos.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.video.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.video.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="youtube_link">{{ trans('cruds.video.fields.youtube_link') }}</label>
                <input class="form-control {{ $errors->has('youtube_link') ? 'is-invalid' : '' }}" type="text" name="youtube_link" id="youtube_link" value="{{ old('youtube_link', '') }}" required>
                @if($errors->has('youtube_link'))
                    <div class="invalid-feedback">
                        {{ $errors->first('youtube_link') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.video.fields.youtube_link_helper') }}</span>
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