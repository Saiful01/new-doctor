@extends('layouts.admin')
@section('content')
@can('guest_patient_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.guest-patients.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.guestPatient.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.guestPatient.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-GuestPatient">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.guestPatient.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.guestPatient.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.guestPatient.fields.dob') }}
                        </th>
                        <th>
                            {{ trans('cruds.guestPatient.fields.phone') }}
                        </th>
                        <th>
                            {{ trans('cruds.guestPatient.fields.address') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($guestPatients as $key => $guestPatient)
                        <tr data-entry-id="{{ $guestPatient->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $guestPatient->id ?? '' }}
                            </td>
                            <td>
                                {{ $guestPatient->name ?? '' }}
                            </td>
                            <td>
                                {{ $guestPatient->dob ?? '' }}
                            </td>
                            <td>
                                {{ $guestPatient->phone ?? '' }}
                            </td>
                            <td>
                                {{ $guestPatient->address ?? '' }}
                            </td>
                            <td>
                                @can('guest_patient_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.guest-patients.show', $guestPatient->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('guest_patient_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.guest-patients.edit', $guestPatient->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('guest_patient_delete')
                                    <form action="{{ route('admin.guest-patients.destroy', $guestPatient->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('guest_patient_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.guest-patients.massDestroy') }}",
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
  let table = $('.datatable-GuestPatient:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection