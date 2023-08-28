@can('doctor_serial_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.doctor-serials.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.doctorSerial.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.doctorSerial.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-doctorDoctorSerials">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.doctorSerial.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.doctorSerial.fields.doctor') }}
                        </th>
                        <th>
                            {{ trans('cruds.doctorSerial.fields.hospital') }}
                        </th>
                        <th>
                            {{ trans('cruds.doctorSerial.fields.type') }}
                        </th>
                        <th>
                            {{ trans('cruds.doctorSerial.fields.title') }}
                        </th>
                        <th>
                            {{ trans('cruds.doctorSerial.fields.is_book') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($doctorSerials as $key => $doctorSerial)
                        <tr data-entry-id="{{ $doctorSerial->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $doctorSerial->id ?? '' }}
                            </td>
                            <td>
                                {{ $doctorSerial->doctor->name ?? '' }}
                            </td>
                            <td>
                                {{ $doctorSerial->hospital->title ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\DoctorSerial::TYPE_RADIO[$doctorSerial->type] ?? '' }}
                            </td>
                            <td>
                                {{ $doctorSerial->title ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\DoctorSerial::IS_BOOK_RADIO[$doctorSerial->is_book] ?? '' }}
                            </td>
                            <td>
                                @can('doctor_serial_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.doctor-serials.show', $doctorSerial->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('doctor_serial_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.doctor-serials.edit', $doctorSerial->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('doctor_serial_delete')
                                    <form action="{{ route('admin.doctor-serials.destroy', $doctorSerial->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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

@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('doctor_serial_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.doctor-serials.massDestroy') }}",
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
  let table = $('.datatable-doctorDoctorSerials:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection