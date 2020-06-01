@extends('admin.layouts.app')

@section('pagetitle')
    <title>Support</title>
@endsection

@section('content')
        <!-- BEGIN : Main Content-->
        <div class="main-content">
          <div class="content-wrapper">
<section id="browse-table">
  <div class="row">
    <div class="col-12">
      @if(Session::has('message'))
      <div class="alert {{ Session::get('alert-class', 'alert-info') }} alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {{ ucfirst(Session::get('message')) }}
      </div>
      @endif
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Support</h4>
        </div>
        <div class="card-content ">
          <div class="card-body card-dashboard table-responsive">
            <table class="table browse-table">
              <thead>
                <tr>
                  <th></th>
                  @foreach($cols as $val)
                  @if($val['B'])
                  <th class="{{ $val['column'] }}">@lang($val['caption'])</th>
                  @endif
                  @endforeach
                  <th style="white-space: nowrap;">Action</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- File export table -->

          </div>
        </div>
@endsection
@section('pagecss')
<link rel="stylesheet" type="text/css" href="{{ asset('/app-assets') }}/vendors/css/tables/datatable/datatables.min.css">
@endsection
@section('pagejs')
<script src="{{ asset('/app-assets') }}/vendors/js/datatable/datatables.min.js" type="text/javascript"></script>
<script src="{{ asset('/app-assets') }}/vendors/js/datatable/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="{{ asset('/app-assets') }}/vendors/js/datatable/buttons.flash.min.js" type="text/javascript"></script>
<script src="{{ asset('/app-assets') }}/vendors/js/datatable/jszip.min.js" type="text/javascript"></script>
<script src="{{ asset('/app-assets') }}/vendors/js/datatable/pdfmake.min.js" type="text/javascript"></script>
<script src="{{ asset('/app-assets') }}/vendors/js/datatable/vfs_fonts.js" type="text/javascript"></script>
<script src="{{ asset('/app-assets') }}/vendors/js/datatable/buttons.html5.min.js" type="text/javascript"></script>
<script src="{{ asset('/app-assets') }}/vendors/js/datatable/buttons.print.min.js" type="text/javascript"></script>
<script>
$(document).ready(function() {
    var resp = false;
    if(window.innerWidth <= 800) resp=true;

    var table = $('.browse-table').DataTable({
        responsive: resp,
        processing: true,
        serverSide: true,
        ajax:{
        url: '{!! url('admin/support/indexjson') !!}',
        headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'POST'
      },
        columns: [
          { data: 'id', name: 'checkbox' },
          @foreach($cols as $val)
          @if($val['B'])
          { data: '{{ $val['column'] }}', name: '{{ $val['dbcolumn'] }}', className:'{{ $val['column'] }}' },
          @endif
          @endforeach
          { data: 'action', name: 'action' },
        ],
        dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
            "<'row'<'col-sm-12'B>>"+
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        buttons: [
            @if(Auth::user()->role_id== 1)
            {
              text: '<i class="ft-plus"></i> Add New', className: 'buttons-add',
              action: function ( e, dt, node, config ) {
                  window.location = '{{ url('admin/support/create') }}'
              }
            },
            @endif  
            { extend: 'colvis', text: 'Show/Hide' }
        ],
        lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        columnDefs: [ {
            targets: 0,
            data: null,
            defaultContent: '',
            orderable: false,
            searchable: false,
            checkboxes: {
                'selectRow': true
            }
        },{
            targets: ['id','created_at','updated_at'],
            visible: false,
            searchable: false,
        },{
            targets: ['description','company','phone','email','city','province'],
            visible: false,
        } ],
        fnRowCallback : function(row, data) {
          // $('td.branch', row).wrapInner('<a title="SPB" href="{{ url('spb') }}?branch_id='+data.id+'" />');
        }
    });
    $('.buttons-colvis').addClass('btn btn-outline-primary mr-1');
    $('.buttons-add').addClass('btn btn-primary mr-1');
    $('.buttons-add').removeClass('btn-secondary');
});
</script>
@endsection
