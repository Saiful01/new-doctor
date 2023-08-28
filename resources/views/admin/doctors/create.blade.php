@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.doctor.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.doctors.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.doctor.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.doctor.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="phone">{{ trans('cruds.doctor.fields.phone') }}</label>
                <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', '') }}">
                @if($errors->has('phone'))
                    <div class="invalid-feedback">
                        {{ $errors->first('phone') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.doctor.fields.phone_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="email">{{ trans('cruds.doctor.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email') }}">
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.doctor.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="designation_id">{{ trans('cruds.doctor.fields.designation') }}</label>
                <select class="form-control select2 {{ $errors->has('designation') ? 'is-invalid' : '' }}" name="designation_id" id="designation_id" required>
                    @foreach($designations as $id => $entry)
                        <option value="{{ $id }}" {{ old('designation_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('designation'))
                    <div class="invalid-feedback">
                        {{ $errors->first('designation') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.doctor.fields.designation_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.doctor.fields.gender') }}</label>
                @foreach(App\Models\Doctor::GENDER_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('gender') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="gender_{{ $key }}" name="gender" value="{{ $key }}" {{ old('gender', '') === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="gender_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('gender'))
                    <div class="invalid-feedback">
                        {{ $errors->first('gender') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.doctor.fields.gender_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="specialists">{{ trans('cruds.doctor.fields.specialist') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('specialists') ? 'is-invalid' : '' }}" name="specialists[]" id="specialists" multiple required>
                    @foreach($specialists as $id => $specialist)
                        <option value="{{ $id }}" {{ in_array($id, old('specialists', [])) ? 'selected' : '' }}>{{ $specialist }}</option>
                    @endforeach
                </select>
                @if($errors->has('specialists'))
                    <div class="invalid-feedback">
                        {{ $errors->first('specialists') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.doctor.fields.specialist_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="hospitals">{{ trans('cruds.doctor.fields.hospital') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('hospitals') ? 'is-invalid' : '' }}" name="hospitals[]" id="hospitals" multiple required>
                    @foreach($hospitals as $id => $hospital)
                        <option value="{{ $id }}" {{ in_array($id, old('hospitals', [])) ? 'selected' : '' }}>{{ $hospital }}</option>
                    @endforeach
                </select>
                @if($errors->has('hospitals'))
                    <div class="invalid-feedback">
                        {{ $errors->first('hospitals') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.doctor.fields.hospital_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="days">{{ trans('cruds.doctor.fields.day') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('days') ? 'is-invalid' : '' }}" name="days[]" id="days" multiple required>
                    @foreach($days as $id => $day)
                        <option value="{{ $id }}" {{ in_array($id, old('days', [])) ? 'selected' : '' }}>{{ $day }}</option>
                    @endforeach
                </select>
                @if($errors->has('days'))
                    <div class="invalid-feedback">
                        {{ $errors->first('days') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.doctor.fields.day_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="address">{{ trans('cruds.doctor.fields.address') }}</label>
                <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" id="address" value="{{ old('address', '') }}">
                @if($errors->has('address'))
                    <div class="invalid-feedback">
                        {{ $errors->first('address') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.doctor.fields.address_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="short_details">{{ trans('cruds.doctor.fields.short_details') }}</label>
                <textarea class="form-control {{ $errors->has('short_details') ? 'is-invalid' : '' }}" name="short_details" id="short_details">{{ old('short_details') }}</textarea>
                @if($errors->has('short_details'))
                    <div class="invalid-feedback">
                        {{ $errors->first('short_details') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.doctor.fields.short_details_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="overview">{{ trans('cruds.doctor.fields.overview') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('overview') ? 'is-invalid' : '' }}" name="overview" id="overview">{!! old('overview') !!}</textarea>
                @if($errors->has('overview'))
                    <div class="invalid-feedback">
                        {{ $errors->first('overview') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.doctor.fields.overview_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="pro_image">{{ trans('cruds.doctor.fields.pro_image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('pro_image') ? 'is-invalid' : '' }}" id="pro_image-dropzone">
                </div>
                @if($errors->has('pro_image'))
                    <div class="invalid-feedback">
                        {{ $errors->first('pro_image') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.doctor.fields.pro_image_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="fee">{{ trans('cruds.doctor.fields.fee') }}</label>
                <input class="form-control {{ $errors->has('fee') ? 'is-invalid' : '' }}" type="number" name="fee" id="fee" value="{{ old('fee', '') }}" step="0.01" required>
                @if($errors->has('fee'))
                    <div class="invalid-feedback">
                        {{ $errors->first('fee') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.doctor.fields.fee_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="old_fee">{{ trans('cruds.doctor.fields.old_fee') }}</label>
                <input class="form-control {{ $errors->has('old_fee') ? 'is-invalid' : '' }}" type="number" name="old_fee" id="old_fee" value="{{ old('old_fee', '') }}" step="0.01">
                @if($errors->has('old_fee'))
                    <div class="invalid-feedback">
                        {{ $errors->first('old_fee') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.doctor.fields.old_fee_helper') }}</span>
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
                xhr.open('POST', '{{ route('admin.doctors.storeCKEditorImages') }}', true);
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
                data.append('crud_id', '{{ $doctor->id ?? 0 }}');
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

<script>
    Dropzone.options.proImageDropzone = {
    url: '{{ route('admin.doctors.storeMedia') }}',
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
      $('form').find('input[name="pro_image"]').remove()
      $('form').append('<input type="hidden" name="pro_image" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="pro_image"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($doctor) && $doctor->pro_image)
      var file = {!! json_encode($doctor->pro_image) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="pro_image" value="' + file.file_name + '">')
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
@endsection