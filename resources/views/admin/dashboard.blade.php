@extends('admin.layouts.app')

@section('pagetitle')
    <title>Dashboard</title>
@endsection

@section('content')
        <!-- BEGIN : Main Content-->
        <div class="main-content">
        <div class="content-wrapper">
<div class="row">
  <div class="col-xl-3 col-lg-6 col-md-6 col-12">
    <div class="card gradient-blackberry">
      <div class="card-content">
        <div class="card-body pt-2 pb-0">
          <div class="media">
            <div class="media-body white text-left">
              <h3 class="font-large-1 mb-0">{{ number_format(($data['number_of_spot'] ?? 0),0) }}</h3>
              <span>Spots</span>
            </div>
            <div class="media-right white text-right">
              <i class="ft-monitor font-large-1"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-lg-6 col-md-6 col-12">
    <div class="card gradient-ibiza-sunset">
      <div class="card-content">
        <div class="card-body pt-2 pb-0">
          <div class="media">
            <div class="media-body white text-left">
              <h3 class="font-large-1 mb-0">{{ number_format(($data['cost'] ?? 0),0) }}</h3>
              <span>Cost (B)</span>
            </div>
            <div class="media-right white text-right">
              <i class="ft-credit-card font-large-1"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-lg-6 col-md-6 col-12">
    <div class="card gradient-green-tea">
      <div class="card-content">
        <div class="card-body pt-2 pb-0">
          <div class="media">
            <div class="media-body white text-left">
              <h3 class="font-large-1 mb-0">{{ number_format(($data['grp'] ?? 0),0) }}</h3>
              <span>GRP</span>
            </div>
            <div class="media-right white text-right">
              <i class="icon-users font-large-1"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-lg-6 col-md-6 col-12">
    <div class="card gradient-pomegranate">
      <div class="card-content">
        <div class="card-body pt-2 pb-0">
          <div class="media">
            <div class="media-body white text-left">
              <h3 class="font-large-1 mb-0">{{ (($data['grp'] ?? 0) > 0)? number_format(($data['cost'] ?? 0)*1000/($data['grp'] ?? 0),0) : 0 }}</h3>
              <span>CPRP (M)</span>
            </div>
            <div class="media-right white text-right">
              <i class="ft-target font-large-1"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-sm-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Total {{ $request->variable ?? 'Spot'}} for Each Channel</h4>
      </div>
      <div class="card-content">
        <div class="card-body">
          <div class="spot-per-channel-chart ct-major-twelfth"></div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-sm-6">
    <div class="card">
      <div class="card-content">
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="product-tab" data-toggle="tab" href="#product" role="tab" aria-controls="product" aria-selected="true">Product</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="advertiser-tab" data-toggle="tab" href="#advertiser" role="tab" aria-controls="advertiser" aria-selected="false">Advertiser</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="sector-tab" data-toggle="tab" href="#sector" role="tab" aria-controls="sector" aria-selected="false">Sector</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="category-tab" data-toggle="tab" href="#category" role="tab" aria-controls="category" aria-selected="false">Category</a>
            </li>
          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="product" role="tabpanel" aria-labelledby="product-tab">
              <h4 class="card-title">Total {{ $request->variable ?? 'Spot'}} for Each Product</h4>
              <div class="card-body card-dashboard table-responsive">
                <table class="table spot-per-product-table">
                  <thead>
                    <tr>
                      <th>PRODUCT</th>
                      <th>{{ $request->variable ?? 'SPOT'}}</th>                
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
            <div class="tab-pane fade" id="advertiser" role="tabpanel" aria-labelledby="advertiser-tab">
            <h4 class="card-title">Total {{ $request->variable ?? 'Spot'}} for Each Advertiser</h4>
              <div class="card-body card-dashboard table-responsive">
                <table class="table spot-per-advertiser-table">
                  <thead>
                    <tr>
                      <th>ADVERTISER</th>
                      <th>{{ $request->variable ?? 'SPOT'}}</th>                
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
            <div class="tab-pane fade" id="sector" role="tabpanel" aria-labelledby="sector-tab">
            <h4 class="card-title">Total {{ $request->variable ?? 'Spot'}} for Each Sector</h4>
              <div class="card-body card-dashboard table-responsive">
                <table class="table spot-per-sector-table">
                  <thead>
                    <tr>
                      <th>SECTOR</th>
                      <th>{{ $request->variable ?? 'SPOT'}}</th>                
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
            <div class="tab-pane fade" id="category" role="tabpanel" aria-labelledby="category-tab">
            <h4 class="card-title">Total {{ $request->variable ?? 'Spot'}} for Each Category</h4>
              <div class="card-body card-dashboard table-responsive">
                <table class="table spot-per-category-table">
                  <thead>
                    <tr>
                      <th>CATEGORY</th>
                      <th>{{ $request->variable ?? 'SPOT'}}</th>                
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          </div>
      </div>
    </div>
  </div>
  <div class="col-sm-6">
  <div class="card">
      <div class="card-content">
      <div class="whitebox">
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="program-tab" data-toggle="tab" href="#program" role="tab" aria-controls="program" aria-selected="true">Program</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="level1-tab" data-toggle="tab" href="#level1" role="tab" aria-controls="level1" aria-selected="false">Level1</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="level2-tab" data-toggle="tab" href="#level2" role="tab" aria-controls="level2" aria-selected="false">Level2</a>
            </li>
          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="program" role="tabpanel" aria-labelledby="program-tab">
              <h4 class="card-title">Total {{ $request->variable ?? 'Spot'}} for Each Program</h4>
              <div class="card-body card-dashboard table-responsive">
                <table class="table spot-per-programme-table">
                  <thead>
                    <tr>
                      <th>PROGRAM</th>
                      <th>{{ $request->variable ?? 'SPOT'}}</th>                
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
            <div class="tab-pane fade" id="level1" role="tabpanel" aria-labelledby="level1-tab">
            <h4 class="card-title">Total {{ $request->variable ?? 'Spot'}} for Each Level1</h4>
              <div class="card-body card-dashboard table-responsive">
                <table class="table spot-per-level1-table">
                  <thead>
                    <tr>
                      <th>LEVEL1</th>
                      <th>{{ $request->variable ?? 'SPOT'}}</th>                
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
            <div class="tab-pane fade" id="level2" role="tabpanel" aria-labelledby="level2-tab">
            <h4 class="card-title">Total {{ $request->variable ?? 'Spot'}} for Each Level2</h4>
              <div class="card-body card-dashboard table-responsive">
                <table class="table spot-per-level2-table">
                  <thead>
                    <tr>
                      <th>LEVEL2</th>
                      <th>{{ $request->variable ?? 'SPOT'}}</th>                
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-sm-6">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Total {{ $request->variable ?? 'Spot'}} for Each Type</h4>
      </div>
      <div class="card-content">
        <div class="card-body">
          <div class="spot-per-type-chart ct-perfect-fifth"></div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-6">
  <div class="card">
    <div class="card-header">
        <h4 class="card-title">Total {{ $request->variable ?? 'Spot'}} for Each Ads Type</h4>
      </div>
      <div class="card-content">
        <div class="card-body card-dashboard table-responsive">
          <table class="table spot-per-adstype-table">
            <thead>
              <tr>
                <th>ADS TYPE</th>
                <th>{{ $request->variable ?? 'SPOT'}}</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-sm-6">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Total {{ $request->variable ?? 'Spot'}} for Each Time Period</h4>
      </div>
      <div class="card-content">
        <div class="card-body">
          <div class="spot-per-time-chart ct-perfect-fifth"></div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-6">
  <div class="card">
    <div class="card-header">
        <h4 class="card-title">Total {{ $request->variable ?? 'Spot'}} for Each Daypart</h4>
      </div>
      <div class="card-content">
        <div class="card-body card-dashboard table-responsive">
          <div class="spot-per-daypart-chart ct-perfect-fifth"></div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-sm-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Total {{ $request->variable ?? 'Spot'}} for Each Date</h4>
      </div>
      <div class="card-content">
        <div class="card-body">
          <div class="spot-per-date-chart ct-major-twelfth"></div>
        </div>
      </div>
    </div>
  </div>
</div>
          </div>
        </div>
@endsection
@section('pagecss')
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets') }}/vendors/css/tables/datatable/datatables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<link rel="stylesheet" type="text/css" href="{{ asset('/') }}app-assets/vendors/css/chartist.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('/') }}app-assets/vendors/css/chartist-plugin-tooltip.css">
<link href="{{ asset('css') }}/jquery.timepicker.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="{{ asset('app-assets') }}/css/bootstrap-select.min.css">
<style>
.card-content{
  min-height: 100px;
}
.ct-series-a .ct-bar, .ct-series-a .ct-line, .ct-series-a .ct-point, .ct-series-a .ct-slice-donut {
    stroke: #0CC162;
}
.ct-series-b .ct-bar, .ct-series-b .ct-line, .ct-series-b .ct-point, .ct-series-b .ct-slice-donut {
    stroke: #33BFE0;
}
.ct-series-c .ct-bar, .ct-series-c .ct-line, .ct-series-c .ct-point, .ct-series-c .ct-slice-donut {
    stroke: #F6C41C;
}
table{
  min-width:100%;
}
.dt-body-right{
  text-align: right;
}
</style>
<style>
#filterersubmit{
  bottom: 10px;
  top: auto;
  width: 85%;
}
#filtererreset{
  bottom: 10px;
  top: auto;
  width: 9%;
  right: auto;
  left: 10px;
  position: absolute;
  padding: 7px;
  z-index: 10;
}
button.search-result{
  min-width:100px;
}
#rtl-icon2{
  position: fixed;
  right: -1px;
  top: 42%;
  width: 54px;
  height: 50px;
  text-align: center;
  cursor: pointer;
  line-height: 50px;
  margin-top: 50px;
  z-index:3;
}
</style>
@endsection
@section('pagejs')
<script src="{{ asset('app-assets') }}/vendors/js/datatable/datatables.min.js" type="text/javascript"></script>
<script src="{{ asset('app-assets') }}/vendors/js/chartist.min.js"></script>
<script src="{{ asset('app-assets') }}/vendors/js/chartist-plugin-tooltip.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="{{ asset('/') }}app-assets/js/filterer.js" type="text/javascript"></script>
<script src="{{ asset('js') }}/jquery.timepicker.min.js"></script>
<script src="{{ asset('app-assets') }}/js/bootstrap-select.min.js"></script>
<script>
  $(document).ready(function(){
    var options = { 'timeFormat': 'H:i:s','step':60 };
    $('#starttime').timepicker(options);
    $('#endtime').timepicker(options);
  });
</script>
<script>
  var data = {
    labels: [
        @if(isset($data['spot_per_channel'])) 
        @foreach($data['spot_per_channel'] as $key=>$val)
          '{{ $val['channel'] }}',
        @endforeach 
        @endif
        ],
    series: [
      [
        @if(isset($data['spot_per_channel'])) 
        @foreach($data['spot_per_channel'] as $key=>$val)
          {{ $val['total'].',' }}
        @endforeach
        @endif
      ]
    ]
  };
  new Chartist.Bar('.spot-per-channel-chart', data,{
    plugins: [
      Chartist.plugins.tooltip()
    ]
  });
</script>
<script>
$(document).ready(function() {
    var resp = false;
    if(window.innerWidth <= 800) resp=true;

    $("#filterersubmit").click(function() {
      $("#loading-modal").modal();
    });

    $.fn.dataTable.ext.errMode = 'none'; // suppress datatables error warning
    var table = $('.spot-per-product-table').DataTable({
        responsive: resp,
        processing: true,
        serverSide: true,
        bLengthChange: false,
        ajax:{
          url: '{!! url('admin/dashboard/spot_per_productjson') !!}',
          headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          type: 'POST',
          data: {            
            @forelse($request->all() as $key=>$val)
            '{{ $key }}': '{{ $val }}',
            @empty
            @endforelse
          }
        },
        columns: [
          { data: '_id.nproduct', name: '_id.nproduct' },
          { data: 'total', name: 'total' },
        ],
        columnDefs: [
          {
              targets: 1,
              className: 'dt-body-right',
                render: $.fn.dataTable.render.number( ',', '.', {{ ($request->variable == 'SPOT')? 0:2}}, '' )
          }
        ],
        dom: "<'row'<'col-sm-12 col-md-6'l>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-10'p>>",
        buttons: [        
        ],
        order: [[1, 'DESC']],
        "oLanguage": {
          "oPaginate": {
          "sFirst": "|<",
          "sPrevious": "&laquo;",
          "sNext": "&raquo;",
          "sLast": ">|"
          }
        }
    });
    var table = $('.spot-per-advertiser-table').DataTable({
        responsive: resp,
        processing: true,
        serverSide: true,
        bLengthChange: false,
        ajax:{
          url: '{!! url('admin/dashboard/spot_per_advertiserjson') !!}',
          headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          type: 'POST',
          data: {            
            @forelse($request->all() as $key=>$val)
            '{{ $key }}': '{{ $val }}',
            @empty
            @endforelse
          }
        },
        columns: [
          { data: '_id.nadvertiser', name: '_id.nadvertiser' },
          { data: 'total', name: 'total' },
        ],
        columnDefs: [
          {
              targets: 1,
              className: 'dt-body-right',
                render: $.fn.dataTable.render.number( ',', '.', {{ ($request->variable == 'SPOT')? 0:2}}, '' )
          }
        ],
        dom: "<'row'<'col-sm-12 col-md-6'l>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-10'p>>",
        buttons: [        
            { extend: 'colvis', text: '<i class="ft-layout"></i>' }
        ],
        order: [[1, 'DESC']],
        "oLanguage": {
          "oPaginate": {
          "sFirst": "|<",
          "sPrevious": "&laquo;",
          "sNext": "&raquo;",
          "sLast": ">|"
          }
        }
    });
    var table = $('.spot-per-sector-table').DataTable({
        responsive: resp,
        processing: true,
        serverSide: true,
        bLengthChange: false,
        ajax:{
          url: '{!! url('admin/dashboard/spot_per_sectorjson') !!}',
          headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          type: 'POST',
          data: {            
            @forelse($request->all() as $key=>$val)
            '{{ $key }}': '{{ $val }}',
            @empty
            @endforelse
          }
        },
        columns: [
          { data: '_id.nsector', name: '_id.nsector' },
          { data: 'total', name: 'total' },
        ],
        columnDefs: [
          {
              targets: 1,
              className: 'dt-body-right',
                render: $.fn.dataTable.render.number( ',', '.', {{ ($request->variable == 'SPOT')? 0:2}}, '' )
          }
        ],
        dom: "<'row'<'col-sm-12 col-md-6'l>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-10'p>>",
        buttons: [        
            { extend: 'colvis', text: '<i class="ft-layout"></i>' }
        ],
        order: [[1, 'DESC']],
        "oLanguage": {
          "oPaginate": {
          "sFirst": "|<",
          "sPrevious": "&laquo;",
          "sNext": "&raquo;",
          "sLast": ">|"
          }
        }
    });
    var table = $('.spot-per-category-table').DataTable({
        responsive: resp,
        processing: true,
        serverSide: true,
        bLengthChange: false,
        ajax:{
          url: '{!! url('admin/dashboard/spot_per_categoryjson') !!}',
          headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          type: 'POST',
          data: {            
            @forelse($request->all() as $key=>$val)
            '{{ $key }}': '{{ $val }}',
            @empty
            @endforelse
          }
        },
        columns: [
          { data: '_id.ncategory', name: '_id.ncategory' },
          { data: 'total', name: 'total' },
        ],
        columnDefs: [
          {
              targets: 1,
              className: 'dt-body-right',
                render: $.fn.dataTable.render.number( ',', '.', {{ ($request->variable == 'SPOT')? 0:2}}, '' )
          }
        ],
        dom: "<'row'<'col-sm-12 col-md-6'l>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-10'p>>",
        buttons: [        
            { extend: 'colvis', text: '<i class="ft-layout"></i>' }
        ],
        order: [[1, 'DESC']],
        "oLanguage": {
          "oPaginate": {
          "sFirst": "|<",
          "sPrevious": "&laquo;",
          "sNext": "&raquo;",
          "sLast": ">|"
          }
        }
    });
    $('.buttons-colvis').addClass('btn btn-outline-primary mr-1');
});
</script>
<script>
$(document).ready(function() {
    var resp = false;
    if(window.innerWidth <= 800) resp=true;

    var table = $('.spot-per-programme-table').DataTable({
        responsive: resp,
        processing: true,
        serverSide: true,
        bLengthChange: false,
        ajax:{
          url: '{!! url('admin/dashboard/spot_per_programmejson') !!}',
          headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          type: 'POST',
          data: {
            @forelse($request->all() as $key=>$val)
            '{{ $key }}': '{{ $val }}',
            @empty
            @endforelse
          }
        },
        columns: [
          { data: '_id.nprogramme', name: '_id.nprogramme' },
          { data: 'total', name: 'total' },
        ],
        columnDefs: [
          {
              targets: 1,
              className: 'dt-body-right',
                render: $.fn.dataTable.render.number( ',', '.', {{ ($request->variable == 'SPOT')? 0:2}}, '' )
          }
        ],
        dom: "<'row'<'col-sm-12 col-md-6'l>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-10'p>>",
        buttons: [        
            { extend: 'colvis', text: '<i class="ft-layout"></i>' }
        ],
        order: [[1, 'DESC']],
        "oLanguage": {
          "oPaginate": {
          "sFirst": "|<",
          "sPrevious": "&laquo;",
          "sNext": "&raquo;",
          "sLast": ">|"
          }
        }
    });
    var table = $('.spot-per-level1-table').DataTable({
        responsive: resp,
        processing: true,
        serverSide: true,
        bLengthChange: false,
        ajax:{
          url: '{!! url('admin/dashboard/spot_per_level1json') !!}',
          headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          type: 'POST',
          data: {
            @forelse($request->all() as $key=>$val)
            '{{ $key }}': '{{ $val }}',
            @empty
            @endforelse
          }
        },
        columns: [
          { data: '_id.nlevel_1', name: '_id.nlevel_1' },
          { data: 'total', name: 'total' },
        ],
        columnDefs: [
          {
              targets: 1,
              className: 'dt-body-right',
                render: $.fn.dataTable.render.number( ',', '.', {{ ($request->variable == 'SPOT')? 0:2}}, '' )
          }
        ],
        dom: "<'row'<'col-sm-12 col-md-6'l>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-10'p>>",
        buttons: [        
            { extend: 'colvis', text: '<i class="ft-layout"></i>' }
        ],
        order: [[1, 'DESC']],
        "oLanguage": {
          "oPaginate": {
          "sFirst": "|<",
          "sPrevious": "&laquo;",
          "sNext": "&raquo;",
          "sLast": ">|"
          }
        }
    });
    var table = $('.spot-per-level2-table').DataTable({
        responsive: resp,
        processing: true,
        serverSide: true,
        bLengthChange: false,
        ajax:{
          url: '{!! url('admin/dashboard/spot_per_level2json') !!}',
          headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          type: 'POST',
          data: {
            @forelse($request->all() as $key=>$val)
            '{{ $key }}': '{{ $val }}',
            @empty
            @endforelse
          }
        },
        columns: [
          { data: '_id.nlevel_2', name: '_id.nlevel_2' },
          { data: 'total', name: 'total' },
        ],
        columnDefs: [
          {
              targets: 1,
              className: 'dt-body-right',
                render: $.fn.dataTable.render.number( ',', '.', {{ ($request->variable == 'SPOT')? 0:2}}, '' )
          }
        ],
        dom: "<'row'<'col-sm-12 col-md-6'l>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-10'p>>",
        buttons: [        
            { extend: 'colvis', text: '<i class="ft-layout"></i>' }
        ],
        order: [[1, 'DESC']],
        "oLanguage": {
          "oPaginate": {
          "sFirst": "|<",
          "sPrevious": "&laquo;",
          "sNext": "&raquo;",
          "sLast": ">|"
          }
        }
    });
    $('.buttons-colvis').addClass('btn btn-outline-primary mr-1');
});
</script>
<script>
$(document).ready(function() {
    var resp = false;
    if(window.innerWidth <= 800) resp=true;

    var table = $('.spot-per-adstype-table').DataTable({
        responsive: resp,
        processing: true,
        serverSide: true,
        bLengthChange: false,
        ajax:{
          url: '{!! url('admin/dashboard/spot_per_adstypejson') !!}',
          headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          type: 'POST',
          data: {
            @forelse($request->all() as $key=>$val)
            '{{ $key }}': '{{ $val }}',
            @empty
            @endforelse
          }
        },
        columns: [
          { data: '_id.nadstype', name: '_id.nadstype' },
          { data: 'total', name: 'total' },
        ],
        columnDefs: [ 
            {
                targets: 1,
                className: 'dt-body-right',
                render: $.fn.dataTable.render.number( ',', '.', {{ ($request->variable == 'SPOT')? 0:2}}, '' )
            }
        ],
        dom: "<'row'<'col-sm-12 col-md-6'l>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-10'p>>",
        buttons: [        
            { extend: 'colvis', text: '<i class="ft-layout"></i>' }
        ],
        order: [[1, 'DESC']],
        "oLanguage": {
          "oPaginate": {
          "sFirst": "|<",
          "sPrevious": "&laquo;",
          "sNext": "&raquo;",
          "sLast": ">|"
          }
        }
    });
    $('.buttons-colvis').addClass('btn btn-outline-primary mr-1');
});
</script>
<script>
  var data = {
    labels: [
        @if(isset($data['spot_per_type'])) 
        @foreach($data['spot_per_type'] as $key=>$val)
          '{{ $key }} ({{ $val }})',
        @endforeach
        @endif
        ],
    series: [
        @if(isset($data['spot_per_type'])) 
        @foreach($data['spot_per_type'] as $key=>$val)
          {{ $val }},
        @endforeach
        @endif
    ]
  };
  new Chartist.Pie('.spot-per-type-chart', data, {donut: true,
    plugins: [
      Chartist.plugins.tooltip()
    ]
  });
</script>
<script>
  var data = {
    labels: [
          'Primetime',
          'Non Primetime',
        ],
    series: [
        @if(isset($data["daypart"])) 
        @foreach($data["daypart"] as $key=>$val)
          @if(strtolower($val['name']) == 'primetime' || strtolower($val['name']) == 'prime time')
            {{ $val['value'] }}
          @endif
        @endforeach
        @endif
        ,
        <?php
        $nonprime = 0;
        if(isset($data["daypart"])):
        foreach($data["daypart"] as $key=>$val):
          if(strtolower($val['name']) != 'primetime' && strtolower($val['name']) != 'prime time'):
             $nonprime = $nonprime + $val['value'];
          endif;
        endforeach;
        endif;
        ?>
        {{ $nonprime }}
    ]
  };
  new Chartist.Pie('.spot-per-time-chart', data, {donut: true,
    plugins: [
      Chartist.plugins.tooltip()
    ]
  });
</script>
<script>
  var data = {
    labels: [
          '{{ $data['daypart'][0]['name'] ?? 0 }}',
          '{{ $data['daypart'][1]['name'] ?? 0 }}',
          '{{ $data['daypart'][2]['name'] ?? 0 }}',
          '{{ $data['daypart'][3]['name'] ?? 0 }}',
          '{{ $data['daypart'][4]['name'] ?? 0 }}',
        ],
    series: [
      [
        {{ $data['daypart'][0]['value'] ?? 0 }},
        {{ $data['daypart'][1]['value'] ?? 0 }},
        {{ $data['daypart'][2]['value'] ?? 0 }},
        {{ $data['daypart'][3]['value'] ?? 0 }},
        {{ $data['daypart'][4]['value'] ?? 0 }},
      ]
    ]
  };
  new Chartist.Bar('.spot-per-daypart-chart', data,{
    plugins: [
      Chartist.plugins.tooltip()
    ]
  });
</script>
<script>
  var data = {
    labels: [
        @if(isset($data['spot_per_date'])) 
        @foreach($data['spot_per_date'] as $key=>$val)
          '{{ $val['date'] }}',
        @endforeach
        @endif
        ],
    series: [
      [
        @if(isset($data['spot_per_date'])) 
        @foreach($data['spot_per_date'] as $key=>$val)
          {{ $val['total'].',' }}
        @endforeach
        @endif
      ]
    ]
  };
  new Chartist.Line('.spot-per-date-chart', data,{
    plugins: [
      Chartist.plugins.tooltip()
    ]
  });
</script>
<script type="text/javascript">
$(function() {
    @if(!empty($request->startdate))
    var start = moment("{{$request->startdate}}");
    $('input[name=startdate]').val(start.format('YYYY-MM-DD'));
    @else
    var start = moment().subtract(6, 'day');
    $('input[name=startdate]').val(start.format('YYYY-MM-DD'));
    @endif    
    @if(!empty($request->enddate))
    var end = moment("{{$request->enddate}}");
    $('input[name=enddate]').val(end.format('YYYY-MM-DD'));
    @else
    var end = moment();
    $('input[name=enddate]').val(end.format('YYYY-MM-DD'));
    @endif

    function cb(start, end) {
        $('#daterange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    }

    $('#daterange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
           'Hari ini': [moment(), moment()],
           'Kemarin': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           '7 Hari': [moment().subtract(6, 'days'), moment()],
           '30 Hari': [moment().subtract(29, 'days'), moment()],
           'Bulan Ini': [moment().startOf('month'), moment().endOf('month')],
           'Bulan Lalu': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);

    cb(start, end);

    $('#daterange').on('apply.daterangepicker', function(ev, picker) {
      daterange = $('#daterange').data('daterangepicker');
      $('#startdate').val(daterange.startDate.format('YYYY-MM-DD'));
      $('#enddate').val(daterange.endDate.format('YYYY-MM-DD'));
    });
});
</script>
<script type="text/javascript">
$(document).ready(function(){
  $(".filter-button").click(function(){
    var filter = $(this).data("filter");
    $("#filter-title").html($(this).html());
    $("input[name=filter-active]").val(filter);
    $("#filter-modal-search-result").empty();
    $('#search-term').val('');
    $("#filter-modal").modal();
    // show existing filter in modal footer
    $("#filter-selected").html('');
    $("#filter-selected").html($("input[name="+filter+"]").val());
    $("#search-button").click();
  });
  $('#search-term').keypress(function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
          $('#search-button').click();
        }
  });
  $("#search-button").click(function(){
    var filter = $("input[name=filter-active]").val();
    $("#filter-modal-search-result").empty();
    var term = $('#search-term').val();
    // get and show search result
    $.ajax({
      url: "{{ url('/admin/adsperformance') }}/search-"+filter+"-json", 
      data: {term: term}, 
      success: function(result){
        if(result.length){
          $.each(result, function(k,v) {
            var curfil = $("#filter-selected").html();
            if(!$("#filter-"+filter).is(':empty') && curfil.indexOf(v[filter] + ';')+1){
              // previously selected, set style
              $('#filter-modal-search-result').append( '<button class="btn search-result btn-primary mr-1" value="'+v[filter]+'">'+v[filter]+'</button>' );
            }else{
              $('#filter-modal-search-result').append( '<button class="btn search-result btn-outline-primary mr-1" value="'+v[filter]+'">'+v[filter]+'</button>' );
            }
          });
        }else{
          $('#filter-modal-search-result').html('<p>No result found</p>');
        }
    }});      
  }); 
  $("#filter-modal-search-result").on('click', '.search-result', function() {
    var filter = $("input[name=filter-active]").val();
    count = $("#filter-"+filter+"-count").html(); // get initial button count
    $(this).toggleClass("btn-outline-primary");
    $(this).toggleClass("btn-primary"); 
    var filt = $(this).val();
    if($(this).hasClass('btn-primary')){
      count++; // selected, increment button count
      $("#filter-selected").html(function(i,html) { 
          html = html + filt + ';';
          return html;
      });
    }else{
      count--; // unselected, decrement button count
      newval = $("#filter-selected").html().replace(/&amp;/g, '&');
      $("#filter-selected").html(newval.replace(filt+';',''));
    }
    $("input[name="+filter+"]").val($("#filter-selected").html());
    if(count>0){
      $("#filter-"+filter+"-count").html(count); // set count at button
    }else{
      $("#filter-"+filter+"-count").html(''); // set count at button
    }
  });
  $("#filter-reset-selected").click(function(){
    var filter = $("input[name=filter-active]").val();
    $(".search-result.btn-primary").addClass("btn-outline-primary");
    $(".search-result.btn-primary").removeClass("btn-primary");    
    $("#filter-selected").html('');
    $("input[name="+filter+"]").val('');
    $("#filter-"+filter+"-count").html(''); // set count at button
  });
});
</script>
<script>
$(document).ready(function(){
  var resp = false;
  if(window.innerWidth <= 800) resp=true;
  
  $("select[name='ntargetaudience']").addClass('selectpicker'); // dropdown search with bootstrap select
  $("select[name='ntargetaudience']").attr('data-live-search','true'); // dropdown search with bootstrap select
  $("select[name='ntargetaudience']").attr('data-size','5'); // dropdown search with bootstrap select
  $("select[name='ntargetaudience']").selectpicker();
});
</script>
<script>
  $(document).ready(function(){
    $("#filtererreset").click(function(){
      var start = moment().subtract(6, 'day');
      $('input[name=startdate]').val(start.format('YYYY-MM-DD'));
      var end = moment();
      $('#daterange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
      $('input[name=enddate]').val(end.format('YYYY-MM-DD'));
      $('input[name=starttime]').val('00:00:00');
      $('input[name=endtime]').val('23:59:59');
      $(".filterer").find('input[type=hidden]').val('');
      $(".filterer").find('select').prop("selectedIndex", 0);
      $("span[id^=filter-]").html('');
      $("select[name='ntargetaudience']").selectpicker("refresh");
    });
});
  
</script>
<script>
$(document).ready(function(){
  $("#rtl-icon2").click(function(){
    var oriaction = $("#filterer-form").attr('action');
    $("#filterer-form").attr('action','{{ url('admin/dashboard/print') }}');
    $("#filterer-form").attr('target','_blank');
    $("#filterer-form").submit();
    $("#filterer-form").attr('action',oriaction);
    $("#filterer-form").attr('target','');
  });
});
</script>
@endsection
@section('filterer')
<a id="rtl-icon2" class="bg-secondary"><i class="ft-printer font-medium-4 white fa align-middle"></i></a>
<form method="GET" id="filterer-form" action="{{ url('admin/dashboard') }}">
<div class="filterer border-left-blue-grey border-left-lighten-4 d-none d-sm-none d-md-block">
<a class="filterer-close"><i class="ft-x font-medium-3"></i></a>
<button type="submit" id="filterersubmit" class="btn btn-warning pull-right filterer-close" style="color:#fff"><i class="ft-filter"></i> Process</button>
<a id="filtererreset" class="btn btn-secondary pull-left" style="color:#fff"><i class="ft-rotate-ccw"></i></a>
<a id="rtl-icon" class="filterer-toggle bg-dark"><i class="ft-filter font-medium-4 fa white align-middle"></i></a>
      <div data-ps-id="8db9d3c9-2e00-94a2-f661-18a2e74f8b35" class="filterer-content p-3 ps-container ps-theme-dark ps-active-y">
        <h4 class="text-uppercase mb-0 text-bold-400">Filter Data</h4>
        <hr>
        <h6 class="text-center text-bold-500 mb-3 text-uppercase">Variabel</h6>
        <select name="variable" class="form-control">
          <option value="SPOT" {{ ($request->variable == 'SPOT') ? 'selected':''}}>SPOT</option>
          <option value="COST" {{ ($request->variable == 'COST') ? 'selected':''}}>COST</option>
          <option value="GRP" {{ ($request->variable == 'GRP') ? 'selected':''}}>GRP</option>
        </select>
        <hr>
        <h6 class="text-center text-bold-500 mb-3 text-uppercase">Period & Time</h6>
          <div id="daterange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc;">
              <i class="fa fa-calendar"></i>&nbsp;
              <span></span> <i class="fa fa-caret-down"></i>
              {{ Form::hidden('startdate',null,['id'=>'startdate']) }}
              {{ Form::hidden('enddate',null,['id'=>'enddate']) }}
          </div>
          <div class="row">
            <div class="col-5">
              {{ Form::text('starttime', $request->starttime ?? '00:00:00', array('id'=>'starttime','class' => 'form-control','required','autocomplete'=>'off')) }}
            </div>
            <div class="col-1" style="top:8px">to</div>
            <div class="col-5">
              {{ Form::text('endtime',  $request->endtime ?? '23:59:59', array('id'=>'endtime','class' => 'form-control','required','autocomplete'=>'off')) }}
            </div>
          </div>
        <hr>
        <h6 class="text-center text-bold-500 mb-3 text-uppercase">Channel</h6>
        <button type="button" class="btn btn-primary col-10 filter-button" data-filter="channel">
        <span id="filter-channel-count">{{ ($request->channel)? count(explode(';',$request->channel))-1:'' }}</span> Channel</button>
        {{ Form::hidden('channel', $request->channel ?? null) }}
        <button type="button" class="btn btn-primary col-5 filter-button" data-filter="nprogramme">
        <span id="filter-nprogramme-count">{{ ($request->nprogramme)? count(explode(';',$request->nprogramme))-1:'' }}</span> nProgramme</button>
        {{ Form::hidden('nprogramme', $request->nprogramme ?? null) }}
        <button type="button" class="btn btn-primary col-5 filter-button" data-filter="iprogramme">
        <span id="filter-iprogramme-count">{{ ($request->iprogramme)? count(explode(';',$request->iprogramme))-1:'' }}</span> iProgramme</button>
        {{ Form::hidden('iprogramme', $request->iprogramme ?? null) }}
        <button type="button" class="btn btn-primary col-5 filter-button" data-filter="nlevel_1">
        <span id="filter-nlevel_1-count">{{ ($request->nlevel_1)? count(explode(';',$request->nlevel_1))-1:'' }}</span> nLevel 1</button>
        {{ Form::hidden('nlevel_1', $request->nlevel_1 ?? null) }}
        <button type="button" class="btn btn-primary col-5 filter-button" data-filter="ilevel_1">
        <span id="filter-ilevel_1-count">{{ ($request->ilevel_1)? count(explode(';',$request->ilevel_1))-1:'' }}</span> iLevel 1</button>
        {{ Form::hidden('ilevel_1', $request->ilevel_1 ?? null) }}
        <button type="button" class="btn btn-primary col-5 filter-button" data-filter="nlevel_2">
        <span id="filter-nlevel_2-count">{{ ($request->nlevel_2)? count(explode(';',$request->nlevel_2))-1:'' }}</span> nLevel 2</button>
        {{ Form::hidden('nlevel_2', $request->nlevel_2 ?? null) }}
        <button type="button" class="btn btn-primary col-5 filter-button" data-filter="ilevel_2">
        <span id="filter-ilevel_2-count">{{ ($request->ilevel_2)? count(explode(';',$request->ilevel_2))-1:'' }}</span> iLevel 2</button>
        {{ Form::hidden('ilevel_2', $request->ilevel_2 ?? null) }}
        <hr>
        <h6 class="text-center text-bold-500 mb-3 text-uppercase">Commercial</h6>
        <button type="button" class="btn btn-primary col-5 filter-button" data-filter="nadvertiser">
        <span id="filter-nadvertiser-count">{{ ($request->nadvertiser)? count(explode(';',$request->nadvertiser))-1:'' }}</span> nAdvertiser</button>
        {{ Form::hidden('nadvertiser', $request->nadvertiser ?? null) }}
        <button type="button" class="btn btn-primary col-5 filter-button" data-filter="iadvertiser">
        <span id="filter-iadvertiser-count">{{ ($request->iadvertiser)? count(explode(';',$request->iadvertiser))-1:'' }}</span> iAdvertiser</button>
        {{ Form::hidden('iadvertiser', $request->iadvertiser ?? null) }}
        <button type="button" class="btn btn-primary col-5 filter-button" data-filter="nproduct">
        <span id="filter-nproduct-count">{{ ($request->nproduct)? count(explode(';',$request->nproduct))-1:'' }}</span> nProduct</button>
        {{ Form::hidden('nproduct', $request->nproduct ?? null) }}
        <button type="button" class="btn btn-primary col-5 filter-button" data-filter="iproduct">
        <span id="filter-iproduct-count">{{ ($request->iproduct)? count(explode(';',$request->iproduct))-1:'' }}</span> iProduct</button>
        {{ Form::hidden('iproduct', $request->iproduct ?? null) }}
        <button type="button" class="btn btn-primary col-5 filter-button" data-filter="nsector">
        <span id="filter-nsector-count">{{ ($request->nsector)? count(explode(';',$request->nsector))-1:'' }}</span> nSector</button>
        {{ Form::hidden('nsector', $request->nsector ?? null) }}
        <button type="button" class="btn btn-primary col-5 filter-button" data-filter="isector">
        <span id="filter-isector-count">{{ ($request->isector)? count(explode(';',$request->isector))-1:'' }}</span> iSector</button>
        {{ Form::hidden('isector', $request->isector ?? null) }}
        <button type="button" class="btn btn-primary col-5 filter-button" data-filter="ncategory">
        <span id="filter-ncategory-count">{{ ($request->ncategory)? count(explode(';',$request->ncategory))-1:'' }}</span> nCategory</button>
        {{ Form::hidden('ncategory', $request->ncategory ?? null) }}
        <button type="button" class="btn btn-primary col-5 filter-button" data-filter="icategory">
        <span id="filter-icategory-count">{{ ($request->icategory)? count(explode(';',$request->icategory))-1:'' }}</span> iCategory</button>
        {{ Form::hidden('icategory', $request->icategory ?? null) }}
        <button type="button" class="btn btn-primary col-5 filter-button" data-filter="nadstype">
        <span id="filter-nadstype-count">{{ ($request->nadstype)? count(explode(';',$request->nadstype))-1:'' }}</span> nAds Type</button>
        {{ Form::hidden('nadstype', $request->nadstype ?? null) }}
        <button type="button" class="btn btn-primary col-5 filter-button" data-filter="iadstype">
        <span id="filter-iadstype-count">{{ ($request->iadstype)? count(explode(';',$request->iadstype))-1:'' }}</span> iAds Type</button>
        {{ Form::hidden('iadstype', $request->iadstype ?? null) }}
        <button type="button" class="btn btn-primary col-5 filter-button" data-filter="tadstype">
        <span id="filter-tadstype-count">{{ ($request->tadstype)? count(explode(';',$request->tadstype))-1:'' }}</span> tAds Type</button>
        {{ Form::hidden('tadstype', $request->tadstype ?? null) }}
        <hr>
        <h6 class="text-center text-bold-500 mb-3 text-uppercase">Target Audience</h6>
        {{ Form::select('ntargetaudience',$data['ddtargetaudience'], ($request->ntargetaudience ?? '') ,['class'=>'form-control']) }}
        <hr>
        <h6 class="text-center text-bold-500 mb-3 text-uppercase">Other</h6>
        <div class="form-group">
        <select name="ncommercialdata" class="form-control col-10">
          <option value="ungrouped" {{ ($request->ncommercialdata == 'ungrouped') ? 'selected':''}}>Ungrouped</option>
          <option value="grouped" {{ ($request->ncommercialdata == 'grouped') ? 'selected':''}}>Grouped</option>
        </select>
        </div>
        <div class="form-group">
        <select name="ncommercialtype" class="form-control col-10">
          <option value="commercialonly"  {{ ($request->ncommercialtype == 'commercialonly') ? 'selected':''}}>Commercial Only</option>
          <option value="allads" {{ ($request->ncommercialtype == 'allads') ? 'selected':''}}>All Ads</option>
        </select>
        </div>
        <div class="form-group">
        <select name="xadstype" class="form-control col-10">
          <option value="alladsype"  {{ ($request->xadstype == 'alladstype') ? 'selected':''}}>All Ads Type</option>
          <option value="loosespot" {{ ($request->xadstype == 'loosespot') ? 'selected':''}}>Loose Spot</option>
          <option value="nonloosespot" {{ ($request->xadstype == 'nonloosespot') ? 'selected':''}}>Non Loose Spot</option>
        </select>
        </div>
        <hr>
        <hr>
        <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 3px;">
          <div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div>
        </div>
        <div class="ps-scrollbar-y-rail" style="top: 0px; height: 295px; right: 3px;">
          <div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 108px;"></div>
        </div>
      </div>
    </div>
</form>
@endsection
@section('modal')
<div class="modal fade text-left show" id="loading-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel8" style="display: none; padding-right: 17px;" aria-modal="true">
  <div class="modal-dialog  modal-s" role="document">
    <div class="modal-content">
      <div class="modal-body" style="text-align:center">
        Loading ... <i class="ft-refresh-cw font-medium-4 fa fa-spin align-middle"></i>        
      </div>
    </div>
  </div>
</div>
<div class="modal fade text-left show" id="filter-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel8" style="display: none; padding-right: 17px;" aria-modal="true">
  <div class="modal-dialog  modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary white">
        <h4 class="modal-title" id="myModalLabel8">Filter <span id="filter-title"></span></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="filter-active"></input>
        <div class="input-group row">
          <div class="col-sm-4">
            <input id="search-term" type="text" class="form-control" placeholder="Cari">
          </div>
            <span class="input-group-btn">
                <button id="search-button" class="btn btn-primary" type="button"><span class="ft-search"></span> Cari</button>
            </span>
        </div>
        <div id="filter-modal-search-result" style="height:250px; overflow-y:scroll">
        </div>
      </div>
      <div class="modal-footer">
        <div id="filter-selected"></div>
        <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Add Filter</button>
        <a id="filter-reset-selected" class="btn btn-secondary pull-left" style="color:#fff"><i class="ft-rotate-ccw"></i></a>
      </div>
    </div>
  </div>
</div>
@endsection
