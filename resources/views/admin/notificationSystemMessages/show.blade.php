@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.notificationSystemMessage.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.notification-system-messages.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                            <button class="btn btn-success" onclick="printMessage()">
                                Enviar email
                            </button>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.notificationSystemMessage.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $notificationSystemMessage->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.notificationSystemMessage.fields.roles') }}
                                    </th>
                                    <td>
                                        @foreach($notificationSystemMessage->roles as $key => $roles)
                                            <span class="label label-info">{{ $roles->title }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.notificationSystemMessage.fields.drivers') }}
                                    </th>
                                    <td>
                                        @foreach($notificationSystemMessage->drivers as $key => $drivers)
                                            <span class="label label-info">{{ $drivers->name }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.notificationSystemMessage.fields.companies') }}
                                    </th>
                                    <td>
                                        @foreach($notificationSystemMessage->companies as $key => $companies)
                                            <span class="label label-info">{{ $companies->name }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.notificationSystemMessage.fields.notification_system_template') }}
                                    </th>
                                    <td>
                                        {{ $notificationSystemMessage->notification_system_template->subject ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.notificationSystemMessage.fields.custom_subject') }}
                                    </th>
                                    <td>
                                        {{ $notificationSystemMessage->custom_subject }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.notificationSystemMessage.fields.message') }}
                                    </th>
                                    <td>
                                        {!! $notificationSystemMessage->message !!}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.notification-system-messages.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script>
        printMessage = () => {
            
        }
    </script>
@endsection