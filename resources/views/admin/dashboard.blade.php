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
                  <h3 class="font-large-1 mb-0">{{ $data['total_event'] }}</h3>
                  <span>Total Events</span>
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
                  <h3 class="font-large-1 mb-0">{{ $data['total_invitation'] }}</h3>
                  <span>Total Invitations</span>
                </div>
                <div class="media-right white text-right">
                  <i class="ft-credit-card font-large-1"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      @if(Auth::user()->role_id == 1)
      <div class="col-xl-3 col-lg-6 col-md-6 col-12">
        <div class="card gradient-cosmic-fusion">
          <div class="card-content">
            <div class="card-body pt-2 pb-0">
              <div class="media">
                <div class="media-body white text-left">
                  <h3 class="font-large-1 mb-0">{{ $data['total_user'] }}</h3>
                  <span>Total Users</span>
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
        <div class="card gradient-love-couple">
          <div class="card-content">
            <div class="card-body pt-2 pb-0">
              <div class="media">
                <div class="media-body white text-left">
                  <h3 class="font-large-1 mb-0">{{ $data['total_partner'] }}</h3>
                  <span>Total Partners</span>
                </div>
                <div class="media-right white text-right">
                  <i class="ft-credit-card font-large-1"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      @else
      <div class="col-md-6">
      @switch(Auth::user()->partner_status)
          @case('Active')
              <button type="button" class="btn btn-primary btnjoin">Partnered</button>
              @break
          @case('New')
              <button type="button" class="btn btnjoin new">Waiting for approval</button>
              @break
          @case('Rejected')
              <a href="{{ url('registerpartner') }}">
                  <button type="button" class="btn btnjoin rejected">Rejected</button>
              </a>
              @break
          @case('Inactive')
              <button type="button" class="btn btnjoin inactive">Inactive</button>
              @break
          @case('Suspended')
              <button type="button" class="btn btnjoin suspended">Suspended</button>
              @break
          @default
          <a href="{{ url('admin/registerpartner') }}">
            <button type="button" class="btn btnjoin default">Join to be our partner</button>
          </a>
      @endswitch        
      </div>  
      @endif
    </div>
    <div class="row">
      <div class="col-sm-6">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Recent Activity</h4>
          </div>
          <div class="card-content">
            <div id="timeline" class="timeline-left timeline-wrapper ml-4 mt-3">
              <ul class="timeline">
                <li class="timeline-line"></li>
                @foreach($data['log'] as $val)
                <li class="timeline-item">
                  @switch($val->tag)
                  @case('Event Invite')
                  <div class="timeline-badge"><span data-toggle="tooltip" data-placement="right" title="Event Invite" class="bg-info bg-lighten-1"><i class="ft-at-sign"></i></span></div>
                  @break
                  @case('Event Approved')
                  <div class="timeline-badge"><span data-toggle="tooltip" data-placement="right" title="Event Approved" class="bg-success bg-lighten-1"><i class="ft-mic"></i></span></div>
                  @break
                  @case('Event Rejected')
                  <div class="timeline-badge"><span data-toggle="tooltip" data-placement="right" title="Event Rejected" class="bg-danger bg-lighten-1"><i class="ft-mic-off"></i></span></div>
                  @break
                  @case('Participant Confirm')
                  <div class="timeline-badge"><span data-toggle="tooltip" data-placement="right" title="Participant Confirm" class="bg-purple bg-lighten-1"><i class="ft-heart"></i></span></div>
                  @break
                  @default
                  <div class="timeline-badge"><span data-toggle="tooltip" data-placement="right" title="" class="bg-grey bg-lighten-1"><i class="ft-alert-circle"></i></span></div>
                  @endswitch
                  <div class="col s9 recent-activity-list-text"><a href="#" class="deep-purple-text medium-small">{{ \Carbon\Carbon::parse($val->created_at)->diffForHumans() }}</a>
                    @if(Auth::user()->role_id==1)
                    <div><small><i class="ft-user"></i> {{ $val->name }} ({{ $val->email }})</small></div>
                    @endif
                    <p class="mt-0 mb-2 fixed-line-height font-weight-300 medium-small">{!! $val->detail !!}</p>
                  </div>
                </li>
                @endforeach
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="card">
          <div class="card-content">
          <div class="card">            
            <div class="card-content">
              <div class="card-body cal1">
                <div id="calendar"></div>
              </div>
            </div>
          </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('pagecss')
<link rel="stylesheet" type="text/css" href="{{asset('css/clndr.css?v=5')}}">
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
.btnjoin{
  position: relative;
  width: 100%;
  padding-right: 15px;
  padding-left: 15px;
  min-height: 100px;
  margin: 18px 0;
  color:white;
  font-size: 27px;
  font-weight: 100;
  border: none;
}
.btnjoin.default{
  background-color: #061ff9;
}
.btnjoin.default:hover{
  background-color: #0315b8;
  color: white;
}
.btnjoin.rejected, .btnjoin.suspended, .btnjoin.inactive{
  background-color: #f20d0d;
}
.btnjoin.rejected:hover{
  background-color: #d50b0b;
  color: white;
}
.btnjoin.suspended:hover, .btnjoin.inactive:hover{
  background-color: #f20d0d;
  color: white;
  cursor: auto;
}
.btnjoin.new{
  background-color: #ff8000;
}
.btnjoin.new:hover{
  background-color: #ff8000;
  color: white;
  cursor: auto;
}
</style>
@endsection
@section('pagejs')
<script src="{{ asset('js') }}/underscore-min.js" type="text/javascript"></script>
<script src="{{ asset('app-assets') }}/vendors/js/moment.min.js" type="text/javascript"></script>
<script>
var clndr = {};
$(document).ready(function(){  
  var events = [
    @foreach($data['event'] as $val)
    { date: '{{ \Carbon\Carbon::parse($val->datetime)->format('Y-m-d') }}', shortdate: '{{ \Carbon\Carbon::parse($val->datetime)->format('d M') }}', title: '{{ $val->event }}', location: '{{ strtoupper($val->address) }}, {{ $val->cityprov }}', url: '{{ url("admin/invitation") }}' },
    @endforeach
  ];

  $('#calendar').clndr({
    events: events,
    forceSixRows: true
  });  
})
</script>
<script src="{{ asset('js') }}/clndr.js?v=2" type="text/javascript"></script>
@endsection