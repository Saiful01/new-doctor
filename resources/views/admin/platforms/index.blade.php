@extends('layouts.admin')
@section('content')
@can('platform_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.platforms.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.platform.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.platform.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Platform">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.platform.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.platform.fields.title') }}
                        </th>
                        <th>
                            {{ trans('cruds.platform.fields.phone') }}
                        </th>
                        <th>
                            {{ trans('cruds.platform.fields.email') }}
                        </th>
                        <th>
                            {{ trans('cruds.platform.fields.address') }}
                        </th>
                        <th>
                            {{ trans('cruds.platform.fields.logo') }}
                        </th>
                        <th>
                            {{ trans('cruds.platform.fields.facebook_url') }}
                        </th>
                        <th>
                            {{ trans('cruds.platform.fields.youtube_url') }}
                        </th>
                        <th>
                            {{ trans('cruds.platform.fields.twiter_url') }}
                        </th>
                        <th>
                            {{ trans('cruds.platform.fields.linked_in_url') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($platforms as $key => $platform)
                        <tr data-entry-id="{{ $platform->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $platform->id ?? '' }}
                            </td>
                            <td>
                                {{ $platform->title ?? '' }}
                            </td>
                            <td>
                                {{ $platform->phone ?? '' }}
                            </td>
                            <td>
                                {{ $platform->email ?? '' }}
                            </td>
                            <td>
                                {{ $platform->address ?? '' }}
                            </td>
                            <td>
                                @if($platform->logo)
                                    <a href="{{ $platform->logo->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $platform->logo->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                            <td>
                                {{ $platform->facebook_url ?? '' }}
                            </td>
                            <td>
                                {{ $platform->youtube_url ?? '' }}
                            </td>
                            <td>
                                {{ $platform->twiter_url ?? '' }}
                            </td>
                            <td>
                                {{ $platform->linked_in_url ?? '' }}
                            </td>
                            <td>
                                @can('platform_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.platforms.show', $platform->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('platform_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.platforms.edit', $platform->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('platform_delete')
                                    <form action="{{ route('admin.platforms.destroy', $platform->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('platform_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.platforms.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-Platform:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection