@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.platform.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.platforms.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.platform.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.platform.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="phone">{{ trans('cruds.platform.fields.phone') }}</label>
                <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', '') }}" required>
                @if($errors->has('phone'))
                    <div class="invalid-feedback">
                        {{ $errors->first('phone') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.platform.fields.phone_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="extra_phone">{{ trans('cruds.platform.fields.extra_phone') }}</label>
                <input class="form-control {{ $errors->has('extra_phone') ? 'is-invalid' : '' }}" type="text" name="extra_phone" id="extra_phone" value="{{ old('extra_phone', '') }}">
                @if($errors->has('extra_phone'))
                    <div class="invalid-feedback">
                        {{ $errors->first('extra_phone') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.platform.fields.extra_phone_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="email">{{ trans('cruds.platform.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email') }}" required>
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.platform.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="address">{{ trans('cruds.platform.fields.address') }}</label>
                <textarea class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" name="address" id="address" required>{{ old('address') }}</textarea>
                @if($errors->has('address'))
                    <div class="invalid-feedback">
                        {{ $errors->first('address') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.platform.fields.address_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="logo">{{ trans('cruds.platform.fields.logo') }}</label>
                <div class="needsclick dropzone {{ $errors->has('logo') ? 'is-invalid' : '' }}" id="logo-dropzone">
                </div>
                @if($errors->has('logo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('logo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.platform.fields.logo_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="facebook_url">{{ trans('cruds.platform.fields.facebook_url') }}</label>
                <input class="form-control {{ $errors->has('facebook_url') ? 'is-invalid' : '' }}" type="text" name="facebook_url" id="facebook_url" value="{{ old('facebook_url', '') }}">
                @if($errors->has('facebook_url'))
                    <div class="invalid-feedback">
                        {{ $errors->first('facebook_url') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.platform.fields.facebook_url_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="youtube_url">{{ trans('cruds.platform.fields.youtube_url') }}</label>
                <input class="form-control {{ $errors->has('youtube_url') ? 'is-invalid' : '' }}" type="text" name="youtube_url" id="youtube_url" value="{{ old('youtube_url', '') }}">
                @if($errors->has('youtube_url'))
                    <div class="invalid-feedback">
                        {{ $errors->first('youtube_url') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.platform.fields.youtube_url_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="twiter_url">{{ trans('cruds.platform.fields.twiter_url') }}</label>
                <input class="form-control {{ $errors->has('twiter_url') ? 'is-invalid' : '' }}" type="text" name="twiter_url" id="twiter_url" value="{{ old('twiter_url', '') }}">
                @if($errors->has('twiter_url'))
                    <div class="invalid-feedback">
                        {{ $errors->first('twiter_url') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.platform.fields.twiter_url_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="linked_in_url">{{ trans('cruds.platform.fields.linked_in_url') }}</label>
                <input class="form-control {{ $errors->has('linked_in_url') ? 'is-invalid' : '' }}" type="text" name="linked_in_url" id="linked_in_url" value="{{ old('linked_in_url', '') }}">
                @if($errors->has('linked_in_url'))
                    <div class="invalid-feedback">
                        {{ $errors->first('linked_in_url') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.platform.fields.linked_in_url_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="about_us">{{ trans('cruds.platform.fields.about_us') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('about_us') ? 'is-invalid' : '' }}" name="about_us" id="about_us">{!! old('about_us') !!}</textarea>
                @if($errors->has('about_us'))
                    <div class="invalid-feedback">
                        {{ $errors->first('about_us') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.platform.fields.about_us_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="objectives">{{ trans('cruds.platform.fields.objectives') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('objectives') ? 'is-invalid' : '' }}" name="objectives" id="objectives">{!! old('objectives') !!}</textarea>
                @if($errors->has('objectives'))
                    <div class="invalid-feedback">
                        {{ $errors->first('objectives') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.platform.fields.objectives_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="professional_experience">{{ trans('cruds.platform.fields.professional_experience') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('professional_experience') ? 'is-invalid' : '' }}" name="professional_experience" id="professional_experience">{!! old('professional_experience') !!}</textarea>
                @if($errors->has('professional_experience'))
                    <div class="invalid-feedback">
                        {{ $errors->first('professional_experience') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.platform.fields.professional_experience_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="academic_qualification">{{ trans('cruds.platform.fields.academic_qualification') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('academic_qualification') ? 'is-invalid' : '' }}" name="academic_qualification" id="academic_qualification">{!! old('academic_qualification') !!}</textarea>
                @if($errors->has('academic_qualification'))
                    <div class="invalid-feedback">
                        {{ $errors->first('academic_qualification') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.platform.fields.academic_qualification_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="training">{{ trans('cruds.platform.fields.training') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('training') ? 'is-invalid' : '' }}" name="training" id="training">{!! old('training') !!}</textarea>
                @if($errors->has('training'))
                    <div class="invalid-feedback">
                        {{ $errors->first('training') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.platform.fields.training_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="services">{{ trans('cruds.platform.fields.services') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('services') ? 'is-invalid' : '' }}" name="services" id="services">{!! old('services') !!}</textarea>
                @if($errors->has('services'))
                    <div class="invalid-feedback">
                        {{ $errors->first('services') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.platform.fields.services_helper') }}</span>
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

@section('scripts')
<script>
    Dropzone.options.logoDropzone = {
    url: '{{ route('admin.platforms.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="logo"]').remove()
      $('form').append('<input type="hidden" name="logo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="logo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($platform) && $platform->logo)
      var file = {!! json_encode($platform->logo) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="logo" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}

</script>
<script>
    $(document).ready(function () {
  function SimpleUploadAdapter(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
      return {
        upload: function() {
          return loader.file
            .then(function (file) {
              return new Promise(function(resolve, reject) {
                // Init request
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '{{ route('admin.platforms.storeCKEditorImages') }}', true);
                xhr.setRequestHeader('x-csrf-token', window._token);
                xhr.setRequestHeader('Accept', 'application/json');
                xhr.responseType = 'json';

                // Init listeners
                var genericErrorText = `Couldn't upload file: ${ file.name }.`;
                xhr.addEventListener('error', function() { reject(genericErrorText) });
                xhr.addEventListener('abort', function() { reject() });
                xhr.addEventListener('load', function() {
                  var response = xhr.response;

                  if (!response || xhr.status !== 201) {
                    return reject(response && response.message ? `${genericErrorText}\n${xhr.status} ${response.message}` : `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`);
                  }

                  $('form').append('<input type="hidden" name="ck-media[]" value="' + response.id + '">');

                  resolve({ default: response.url });
                });

                if (xhr.upload) {
                  xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                      loader.uploadTotal = e.total;
                      loader.uploaded = e.loaded;
                    }
                  });
                }

                // Send request
                var data = new FormData();
                data.append('upload', file);
                data.append('crud_id', '{{ $platform->id ?? 0 }}');
                xhr.send(data);
              });
            })
        }
      };
    }
  }

  var allEditors = document.querySelectorAll('.ckeditor');
  for (var i = 0; i < allEditors.length; ++i) {
    ClassicEditor.create(
      allEditors[i], {
        extraPlugins: [SimpleUploadAdapter]
      }
    );
  }
});
</script>

@endsection