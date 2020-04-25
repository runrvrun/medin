@extends('admin.layouts.print')

@section('pagetitle')
    <title>Vislog - Dashboard</title>
@endsection

@section('content')
        <!-- BEGIN : Main Content-->
        <div class="main-content">
        <div class="content-wrapper">
<div class="row bg-brown text-center" style="padding-top:15px;">
  <div class="col-md-3"><img src="{{ asset('images/vislog-logo-white.png') }}" width="32px" /></div>
  <div class="col-md-6 white">
  <h3>Vislog Dashboard Report</h3>
  <p>{{ $request->startdate }} - {{ $request->enddate }}</p>
  </div>
</div>
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
              <h3 class="font-large-1 mb-0">{{ number_format($data['cost'],2) }}</h3>
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
              <h3 class="font-large-1 mb-0">{{ number_format($data['grp'],0) }}</h3>
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
              <h3 class="font-large-1 mb-0">{{ ($data['grp'] > 0)? number_format($data['cost']*1000/$data['grp'],2) : '0.00' }}</h3>
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
      <div class="card-header">
        <h4 class="card-title">Total {{ $request->variable ?? 'Spot'}} for Each Product</h4>
      </div>
      <div class="card-content">
        <div class="card-body card-dashboard table-responsive">
          <table class="table spot-per-product-table">
            <thead>
              <tr>
                <th>Product</th>
                <th>{{ $request->variable ?? 'Spot'}}</th>                
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-6">
  <div class="card">
    <div class="card-header">
        <h4 class="card-title">Total {{ $request->variable ?? 'Spot'}} for Each Program</h4>
      </div>
      <div class="card-content">
        <div class="card-body card-dashboard table-responsive">
          <table class="table spot-per-programme-table">
            <thead>
              <tr>
                <th>Program</th>
                <th>{{ $request->variable ?? 'Spot'}}</th>
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
                <th>Ads Type</th>
                <th>{{ $request->variable ?? 'Spot'}}</th>
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
@endsection
@section('pagecss')
<link rel="stylesheet" type="text/css" media="all" href="{{ asset('app-assets') }}/vendors/css/tables/datatable/datatables.min.css">
<link rel="stylesheet" type="text/css" media="all" href="{{ asset('/') }}app-assets/vendors/css/chartist.min.css">
<link rel="stylesheet" type="text/css" media="all" href="{{ asset('/') }}app-assets/vendors/css/chartist-plugin-tooltip.css">
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
/* additional css for print */
.main-panel .main-content {
  padding-left:0px;
}
.bg-brown{
  background-color: #804848;
}
</style>
@endsection
@section('pagejs')
<script src="{{ asset('app-assets') }}/vendors/js/datatable/datatables.min.js" type="text/javascript"></script>
<script src="{{ asset('app-assets') }}/vendors/js/chartist.min.js"></script>
<script src="{{ asset('app-assets') }}/vendors/js/chartist-plugin-tooltip.js"></script>
<script>
$(document).ready(function() {
    var resp = false;
    if(window.innerWidth <= 800) resp=true;

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
            "<'row'<'col-sm-12'tr>>",
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
            "<'row'<'col-sm-12'tr>>",
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
            "<'row'<'col-sm-12'tr>>",
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

    var data = {
    labels: [
        @foreach($data['spot_per_channel'] as $key=>$val)
          '{{ $val['channel'] }}',
        @endforeach
        ],
    series: [
      [
        @foreach($data['spot_per_channel'] as $key=>$val)
          {{ $val['total'].',' }}
        @endforeach
      ]
    ]
  };
  new Chartist.Bar('.spot-per-channel-chart', data,{
    plugins: [
      Chartist.plugins.tooltip()
    ]
  });

var data = {
    labels: [
        @foreach($data['spot_per_type'] as $key=>$val)
          '{{ $key }} ({{ $val }})',
        @endforeach
        ],
    series: [
        @foreach($data['spot_per_type'] as $key=>$val)
          {{ $val }},
        @endforeach
    ]
  };
  new Chartist.Pie('.spot-per-type-chart', data, {donut: true,
    plugins: [
      Chartist.plugins.tooltip()
    ]
  });

  var data = {
    labels: [
          'Primetime',
          'Non Primetime',
        ],
    series: [
        @foreach($data["daypart"] as $key=>$val)
          @if($val['name'] == 'Primetime')
            {{ $val['value'] }}
          @endif
        @endforeach
        ,
        <?php
        $nonprime = 0;
        foreach($data["daypart"] as $key=>$val):
          if($val['name'] != 'Primetime'):
             $nonprime = $nonprime + $val['value'];
          endif;
        endforeach;
        ?>
        {{ $nonprime }}
    ]
  };
  new Chartist.Pie('.spot-per-time-chart', data, {donut: true,
    plugins: [
      Chartist.plugins.tooltip()
    ]
  });

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
  
  var data = {
    labels: [
        @foreach($data['spot_per_date'] as $key=>$val)
          '{{ $val['date'] }}',
        @endforeach
        ],
    series: [
      [
        @foreach($data['spot_per_date'] as $key=>$val)
          {{ $val['total'].',' }}
        @endforeach
      ]
    ]
  };
  new Chartist.Line('.spot-per-date-chart', data,{
    plugins: [
      Chartist.plugins.tooltip()
    ]
  });
});
$(window).on('load',function(){
    setTimeout(function() {
      window.print();
      setTimeout(window.close, 0);
    }, 2000);
});
</script>
@endsection