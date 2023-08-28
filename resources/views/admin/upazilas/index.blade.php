@extends('layouts.admin')
@section('content')
@can('upazila_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.upazilas.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.upazila.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.upazila.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Upazila">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.upazila.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.upazila.fields.district') }}
                        </th>
                        <th>
                            {{ trans('cruds.upazila.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.upazila.fields.bn_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.upazila.fields.url') }}
                        </th>
                        <th>
                            {{ trans('cruds.upazila.fields.police_station_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.upazila.fields.type') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($upazilas as $key => $upazila)
                        <tr data-entry-id="{{ $upazila->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $upazila->id ?? '' }}
                            </td>
                            <td>
                                {{ $upazila->district->name ?? '' }}
                            </td>
                            <td>
                                {{ $upazila->name ?? '' }}
                            </td>
                            <td>
                                {{ $upazila->bn_name ?? '' }}
                            </td>
                            <td>
                                {{ $upazila->url ?? '' }}
                            </td>
                            <td>
                                {{ $upazila->police_station_name ?? '' }}
                            </td>
                            <td>
                                {{ $upazila->type ?? '' }}
                            </td>
                            <td>
                                @can('upazila_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.upazilas.show', $upazila->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('upazila_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.upazilas.edit', $upazila->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('upazila_delete')
                                    <form action="{{ route('admin.upazilas.destroy', $upazila->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('upazila_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.upazilas.massDestroy') }}",
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
  let table = $('.datatable-Upazila:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection