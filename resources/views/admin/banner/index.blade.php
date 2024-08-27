@extends('layouts.admin')
@section('content')
@can('course_banner_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.course_banners.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.course_banner.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.course_banner.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-CourseBanner">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.course_banner.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.course_banner.fields.title') }}
                        </th>
                        <th>
                            {{ trans('cruds.course_banner.fields.description') }}
                        </th>
                        <th>
                            {{ trans('cruds.course_banner.fields.image_url') }}
                        </th>
                        <th>
                            {{ trans('cruds.course_banner.fields.is_active') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($courseBanners as $key => $courseBanner)
                        <tr data-entry-id="{{ $courseBanner->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $courseBanner->id ?? '' }}
                            </td>
                            <td>
                                {{ $courseBanner->title ?? '' }}
                            </td>
                            <td>
                                {{ $courseBanner->description ?? '' }}
                            </td>
                            <td>
                                @if($courseBanner->image_url)
                                    <a href="{{ $courseBanner->image_url }}" target="_blank">
                                        <img src="{{ $courseBanner->image_url }}" width="50px" height="50px">
                                    </a>
                                @endif
                            </td>
                            <td>
                                {{ $courseBanner->is_active ? trans('global.yes') : trans('global.no') }}
                            </td>
                            <td>
                                @can('course_banner_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.course_banners.show', $courseBanner->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('course_banner_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.course_banners.edit', $courseBanner->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('course_banner_delete')
                                    <form action="{{ route('admin.course_banners.destroy', $courseBanner->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('course_banner_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.course_banners.massDestroy') }}",
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
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  $('.datatable-CourseBanner:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection
