@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.notificationSystemMessage.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.notification-system-messages.update", [$notificationSystemMessage->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group {{ $errors->has('roles') ? 'has-error' : '' }}">
                            <label for="roles">{{ trans('cruds.notificationSystemMessage.fields.roles') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="roles[]" id="roles" multiple>
                                @foreach($roles as $id => $role)
                                    <option value="{{ $id }}" {{ (in_array($id, old('roles', [])) || $notificationSystemMessage->roles->contains($id)) ? 'selected' : '' }}>{{ $role }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('roles'))
                                <span class="help-block" role="alert">{{ $errors->first('roles') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.notificationSystemMessage.fields.roles_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('drivers') ? 'has-error' : '' }}">
                            <label for="drivers">{{ trans('cruds.notificationSystemMessage.fields.drivers') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="drivers[]" id="drivers" multiple>
                                @foreach($drivers as $id => $driver)
                                    <option value="{{ $id }}" {{ (in_array($id, old('drivers', [])) || $notificationSystemMessage->drivers->contains($id)) ? 'selected' : '' }}>{{ $driver }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('drivers'))
                                <span class="help-block" role="alert">{{ $errors->first('drivers') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.notificationSystemMessage.fields.drivers_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('companies') ? 'has-error' : '' }}">
                            <label for="companies">{{ trans('cruds.notificationSystemMessage.fields.companies') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="companies[]" id="companies" multiple>
                                @foreach($companies as $id => $company)
                                    <option value="{{ $id }}" {{ (in_array($id, old('companies', [])) || $notificationSystemMessage->companies->contains($id)) ? 'selected' : '' }}>{{ $company }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('companies'))
                                <span class="help-block" role="alert">{{ $errors->first('companies') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.notificationSystemMessage.fields.companies_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('notification_system_template') ? 'has-error' : '' }}">
                            <label for="notification_system_template_id">{{ trans('cruds.notificationSystemMessage.fields.notification_system_template') }}</label>
                            <select class="form-control select2" name="notification_system_template_id" id="notification_system_template_id">
                                @foreach($notification_system_templates as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('notification_system_template_id') ? old('notification_system_template_id') : $notificationSystemMessage->notification_system_template->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('notification_system_template'))
                                <span class="help-block" role="alert">{{ $errors->first('notification_system_template') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.notificationSystemMessage.fields.notification_system_template_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('custom_subject') ? 'has-error' : '' }}">
                            <label class="required" for="custom_subject">{{ trans('cruds.notificationSystemMessage.fields.custom_subject') }}</label>
                            <input class="form-control" type="text" name="custom_subject" id="custom_subject" value="{{ old('custom_subject', $notificationSystemMessage->custom_subject) }}" required>
                            @if($errors->has('custom_subject'))
                                <span class="help-block" role="alert">{{ $errors->first('custom_subject') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.notificationSystemMessage.fields.custom_subject_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('message') ? 'has-error' : '' }}">
                            <label for="message">{{ trans('cruds.notificationSystemMessage.fields.message') }}</label>
                            <textarea class="form-control ckeditor" name="message" id="message">{!! old('message', $notificationSystemMessage->message) !!}</textarea>
                            @if($errors->has('message'))
                                <span class="help-block" role="alert">{{ $errors->first('message') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.notificationSystemMessage.fields.message_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>



        </div>
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
                xhr.open('POST', '{{ route('admin.notification-system-messages.storeCKEditorImages') }}', true);
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
                data.append('crud_id', '{{ $notificationSystemMessage->id ?? 0 }}');
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