@extends('admin.layouts.app')

@section('pagetitle')
    <title>Partner</title>
@endsection

@section('content')
        <!-- BEGIN : Main Content-->
        <div class="main-content">
          <div class="content-wrapper"><!-- DOM - jQuery events table -->
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
          <h4 class="card-title">Partner</h4>
        </div>
        <div class="card-content ">
          <div class="card-body card-dashboard table-responsive">
            <table class="table browse-table">
              <thead>
                <tr>
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
<link rel="stylesheet" type="text/css" href="{{ asset('') }}app-assets/vendors/css/tables/datatable/datatables.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('css') }}/ekko-lightbox.css">
<style>
.media{
  display: table-cell !important;
}
.btn.New{
  color: #fff;
  background-color: #189fb6;
  border-color: #189fb6;
  min-width:85px;
}
.btn.Active{
  color: #fff;
  background-color: #0CC27E;
  border-color: #0CC27E;
  min-width:85px;
}
.btn.Rejected{
  color: #fff;
  background-color: #FF586B;
  border-color: #FF586B;
  min-width:85px;
}
.btn.Inactive{
  color: #fff;
  background-color: #FF8D60;
  border-color: #FF8D60;
  min-width:85px;
}
</style>
@endsection
@section('pagejs')
<script src="{{ asset('') }}app-assets/vendors/js/datatable/datatables.min.js" type="text/javascript"></script>
<script src="{{ asset('') }}app-assets/vendors/js/datatable/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="{{ asset('') }}app-assets/vendors/js/datatable/buttons.flash.min.js" type="text/javascript"></script>
<script src="{{ asset('') }}app-assets/vendors/js/datatable/jszip.min.js" type="text/javascript"></script>
<script src="{{ asset('') }}app-assets/vendors/js/datatable/pdfmake.min.js" type="text/javascript"></script>
<script src="{{ asset('') }}app-assets/vendors/js/datatable/vfs_fonts.js" type="text/javascript"></script>
<script src="{{ asset('') }}app-assets/vendors/js/datatable/buttons.html5.min.js" type="text/javascript"></script>
<script src="{{ asset('') }}app-assets/vendors/js/datatable/buttons.print.min.js" type="text/javascript"></script>
<script src="{{ asset('js') }}/ekko-lightbox.js" type="text/javascript"></script>
<script>
$(document).ready(function() {
    var resp = false;
    if(window.innerWidth <= 800) resp=true;

    var table = $('.browse-table').DataTable({
        responsive: resp,
        processing: true,
        serverSide: true,
        ajax:{
          url: '{!! url('admin/user/indexjson/partner') !!}',
          headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          type: 'POST'
        },
        columns: [
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
            { extend: 'colvis', text: 'Column' },
        ],
        lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        columnDefs: [ {
            targets: 0,
            data: null,
            defaultContent: '',
            orderable: false,
            searchable: false,
        },{
            targets: ['address','id_no','email_verified_at','company_address','city','role'],
            visible: false,
        },{
            targets: ['id','created_at','updated_at'],
            visible: false,
            searchable: false,
        } ],
        fnRowCallback : function(row, data) {
          $('td.status', row).wrapInner('<button class="btn '+data.status+'" />');        
          $('td.partner_status', row).wrapInner('<button class="btn '+data.partner_status+'" />');
          $('td.avatar', row).wrapInner('<a href="{{ asset('') }}'+data.avatar+'" data-toggle="lightbox" data-max-width="600"><img src="{{ asset('') }}'+data.avatar+'" class="img-fluid"></a>');
        }
    });
    $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel, .buttons-colvis, .buttons-csvall').addClass('btn btn-outline-primary mr-1');
    $('.buttons-add').addClass('btn btn-primary mr-1');
    $('.buttons-add').removeClass('btn-secondary');

});
$(document).on('click', '[data-toggle="lightbox"]', function(event) {
                event.preventDefault();
                $(this).ekkoLightbox();
            });
</script>
@endsection
