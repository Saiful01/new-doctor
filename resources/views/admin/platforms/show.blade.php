@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.platform.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.platforms.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.platform.fields.id') }}
                        </th>
                        <td>
                            {{ $platform->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.platform.fields.title') }}
                        </th>
                        <td>
                            {{ $platform->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.platform.fields.phone') }}
                        </th>
                        <td>
                            {{ $platform->phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.platform.fields.extra_phone') }}
                        </th>
                        <td>
                            {{ $platform->extra_phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.platform.fields.email') }}
                        </th>
                        <td>
                            {{ $platform->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.platform.fields.address') }}
                        </th>
                        <td>
                            {{ $platform->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.platform.fields.logo') }}
                        </th>
                        <td>
                            @if($platform->logo)
                                <a href="{{ $platform->logo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $platform->logo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.platform.fields.facebook_url') }}
                        </th>
                        <td>
                            {{ $platform->facebook_url }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.platform.fields.youtube_url') }}
                        </th>
                        <td>
                            {{ $platform->youtube_url }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.platform.fields.twiter_url') }}
                        </th>
                        <td>
                            {{ $platform->twiter_url }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.platform.fields.linked_in_url') }}
                        </th>
                        <td>
                            {{ $platform->linked_in_url }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.platform.fields.about_us') }}
                        </th>
                        <td>
                            {!! $platform->about_us !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.platform.fields.objectives') }}
                        </th>
                        <td>
                            {!! $platform->objectives !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.platform.fields.professional_experience') }}
                        </th>
                        <td>
                            {!! $platform->professional_experience !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.platform.fields.academic_qualification') }}
                        </th>
                        <td>
                            {!! $platform->academic_qualification !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.platform.fields.training') }}
                        </th>
                        <td>
                            {!! $platform->training !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.platform.fields.services') }}
                        </th>
                        <td>
                            {!! $platform->services !!}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.platforms.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection