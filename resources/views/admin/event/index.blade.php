@extends('admin.layouts.app')

@section('pagetitle')
    <title>Events</title>
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
          <h4 class="card-title">Events</h4>
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
@section('modal')
<div class="modal fade text-left show" id="invitation-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel8" style="display: none; padding-right: 17px;" aria-modal="true">
  <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary white">
        <h4 class="modal-title" id="myModalLabel8"><span id="event-type-modal">Invitation</span> for <span id="event-title-modal"></span></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade text-left" id="event-status-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" style="display: none;" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel1">Event: <span id="event-status-name"></span></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form method="POST" id="event-status-form">
      <input name="_method" type="hidden" value="PATCH">
      @csrf
      <div class="modal-body">
        Status: <select name="status" id="event-status-select" class="form-control">
          <option value="New">New</option>
          <option value="Ongoing">Ongoing</option>
          <option value="Rejected">Rejected</option>
          <option value="Canceled">Canceled</option>
          <option value="Closed">Closed</option>
        </select>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success">Simpan</button>
        <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Batal</button>
      </div>
      </form>
    </div>
  </div>
</div>   
@endsection
@section('pagecss')
<link rel="stylesheet" type="text/css" href="{{ asset('/app-assets') }}/vendors/css/tables/datatable/datatables.min.css">
<style>
.action-badge{
  position: relative;
  top: -8px;
  right: 16px;
}
.btn.media-item{
  padding:5px;
  width: 154px;
  margin-bottom: 0;
  margin-right: 10px;
}
.btn.New{
  color: #fff;
  background-color: #189fb6;
  border-color: #189fb6;
  min-width:85px;
}
.btn.Ongoing{
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
.btn.Canceled{
  color: #fff;
  background-color: #FF8D60;
  border-color: #FF8D60;
  min-width:85px;
}
.btn.Closed{
  color: #fff;
  background-color: #868e96;
  border-color: #868e96
  min-width:85px;
}
</style>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script>
$(document).ready(function() {
    var resp = false;
    if(window.innerWidth <= 800) resp=true;

    var table = $('.browse-table').DataTable({
        responsive: resp,
        processing: true,
        serverSide: true,
        ajax:{
        url: '{!! url('admin/event/indexjson') !!}',
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
            @if(Auth::user()->role_id==1)
            // {
            //   text: '<i class="ft-plus"></i> Add New', className: 'buttons-add',
            //   action: function ( e, dt, node, config ) {
            //       window.location = '{{ url('admin/event/create') }}'
            //   }
            // },  
            @endif
            {
              text: '<i class="ft-plus-circle"></i> Create', className: 'buttons-add',
              action: function ( e, dt, node, config ) {
                  window.location = '{{ url('admin/event/createwizard') }}'
              }
            },  
            { extend: 'colvis', text: 'Show/Hide' }
        ],
        lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        columnDefs: [ {
            targets: 0,
            data: null,
            defaultContent: '',
            orderable: false,
            searchable: false,            
        },{
            targets: ['id','created_at','updated_at'],
            visible: false,
            searchable: false,
        },{
            targets: ['description','company','phone','email','city','province'],
            visible: false,
        },{
            targets:['datetime'], render:function(data){
            return moment(data).format('ddd, DD MMM YYYY');
        }} 
        ],
        fnRowCallback : function(row, data) {
          @if(Auth::user()->role_id == 1)
          $('td.status', row).wrapInner('<button data-id="'+data.id+'" data-event="'+data.event+'" data-status="'+data.status+'" class="btn '+data.status+' show-event-status-modal" />');
          @else
          $('td.status', row).wrapInner('<button class="btn '+data.status+'" />');
          @endif
        }
    });
    $('.buttons-colvis').addClass('btn btn-outline-primary mr-1');
    $('.buttons-add').addClass('btn btn-primary mr-1');
    $('.buttons-add').removeClass('btn-secondary');  
});
$('body').on('click','.btninvitation',function(){
  $("#invitation-modal").modal();
  $("#event-type-modal").html('Invitation');
  $("#event-title-modal").html($(this).data('event'));
  $.ajax({
    url: "{{ url('/admin/event/getinvitation') }}", 
    data: {eventid: $(this).data('eventid')}, 
    success: function(result){
      if(result.length){
          $('#invitation-modal .modal-body').empty();
        $.each(result, function(k,v) {
          $('#invitation-modal .modal-body').append("<button id='"+v.id+"' type='button' class='media-item btn btn-primary'><div class='image'><img src='{{ asset('/') }}/"+v.avatar+"'></div><div class='name'>"+v.name+"</div><div class='company'><small>["+v.media_type+"] "+v.media+"</small></div></button>");
        });
      }else{
        $('#invitation-modal .modal-body').html('<p>No result found</p>');
      }
  }});     
});
$('body').on('click','.btnparticipant',function(){
  $("#invitation-modal").modal();
  $("#event-type-modal").html('Participant');
  $("#event-title-modal").html($(this).data('event'));
  $.ajax({
    url: "{{ url('/admin/event/getparticipant') }}", 
    data: {eventid: $(this).data('eventid')}, 
    success: function(result){
      if(result.length){
          $('#invitation-modal .modal-body').empty();
        $.each(result, function(k,v) {
          $('#invitation-modal .modal-body').append("<button id='"+v.id+"' type='button' class='media-item btn btn-primary'><div class='image'><img src='{{ asset('/') }}/"+v.avatar+"'></div><div class='name'>"+v.name+"</div><div class='company'><small>["+v.media_type+"] "+v.media+"</small></div></button>");
        });
      }else{
        $('#invitation-modal .modal-body').html('<p>No result found</p>');
      }
  }});     
});
@if(Auth::user()->role_id == 1)
$('body').on('click','.show-event-status-modal',function(){
  $("#event-status-name").html($(this).data("event"));
  $("#event-status-form").attr('action','{{ url('admin/event/') }}/'+$(this).data("id")+'/updatestatus');
  $("#event-status-select").val($(this).data("status"));
  $("#event-status-modal").modal('show');
});
@endif
</script>
@endsection
