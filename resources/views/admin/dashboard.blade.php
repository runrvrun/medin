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
      <div class="col-md-6">
      @switch(Auth::user()->partner_status)
          @case('Active')
              <button type="button" class="btn btn-primary btnjoin">Partnered</button>
              @break
          @case('New')
              <button type="button" class="btn btnjoin new">Waiting for approval</button>
              @break
          @case('Rejected')
              <a href="{{ url('admin/registerpartner') }}">
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
                <li class="timeline-item">
                  <div class="timeline-badge"><span data-toggle="tooltip" data-placement="right" title="Portfolio project work" class="bg-purple bg-lighten-1"><i class="ft-shopping-cart"></i></span></div>
                  <div class="col s9 recent-activity-list-text"><a href="#" class="deep-purple-text medium-small">just now</a>
                    <p class="mt-0 mb-2 fixed-line-height font-weight-300 medium-small">Jim Doe Purchased new equipments for zonal office.</p>
                  </div>
                </li>
                <li class="timeline-item">
                  <div class="timeline-badge"><span data-toggle="tooltip" data-placement="right" title="Portfolio project work" class="bg-info bg-lighten-1"><i class="fa fa-plane"></i></span></div>
                  <div class="col s9 recent-activity-list-text"><a href="#" class="cyan-text medium-small">Yesterday</a>
                    <p class="mt-0 mb-2 fixed-line-height font-weight-300 medium-small">Your Next flight for USA will be on 15th August 2015.</p>
                  </div>
                </li>
                <li class="timeline-item">
                  <div class="timeline-badge"><span data-toggle="tooltip" data-placement="right" title="Portfolio project work" class="bg-success bg-lighten-1"><i class="ft-mic"></i></span></div>
                  <div class="col s9 recent-activity-list-text"><a href="#" class="green-text medium-small">5 Days Ago</a>
                    <p class="mt-0 mb-2 fixed-line-height font-weight-300 medium-small">Natalya Parker Send you a voice mail for next conference.</p>
                  </div>
                </li>
                <li class="timeline-item">
                  <div class="timeline-badge"><span data-toggle="tooltip" data-placement="right" title="Portfolio project work" class="bg-warning bg-lighten-1"><i class="ft-map-pin"></i></span></div>
                  <div class="col s9 recent-activity-list-text"><a href="#" class="amber-text medium-small">1 Week Ago</a>
                    <p class="mt-0 mb-2 fixed-line-height font-weight-300 medium-small">Jessy Jay open a new store at S.G Road.</p>
                  </div>
                </li>
                <li class="timeline-item">
                  <div class="timeline-badge"><span data-toggle="tooltip" data-placement="right" title="Portfolio project work" class="bg-red bg-lighten-1"><i class="ft-inbox"></i></span></div>
                  <div class="col s9 recent-activity-list-text"><a href="#" class="deep-orange-text medium-small">2 Week Ago</a>
                    <p class="mt-0 mb-2 fixed-line-height font-weight-300 medium-small">voice mail for conference.</p>
                  </div>
                </li>
                <li class="timeline-item">
                  <div class="timeline-badge"><span data-toggle="tooltip" data-placement="right" title="Portfolio project work" class="bg-cyan bg-lighten-1"><i class="ft-mic"></i></span></div>
                  <div class="col s9 recent-activity-list-text"><a href="#" class="brown-text medium-small">1 Month Ago</a>
                    <p class="mt-0 mb-2 fixed-line-height font-weight-300 medium-small">Natalya Parker Send you a voice mail for next conference.</p>
                  </div>
                </li>
                <li class="timeline-item">
                  <div class="timeline-badge"><span data-toggle="tooltip" data-placement="right" title="Portfolio project work" class="bg-amber bg-lighten-1"><i class="ft-map-pin"></i></span></div>
                  <div class="col s9 recent-activity-list-text"><a href="#" class="deep-purple-text medium-small">3 Month Ago</a>
                    <p class="mt-0 mb-2 fixed-line-height font-weight-300 medium-small">Jessy Jay open a new store at S.G Road.</p>
                  </div>
                </li>
                <li class="timeline-item">
                  <div class="timeline-badge"><span data-toggle="tooltip" data-placement="right" title="Portfolio project work" class="bg-grey bg-lighten-1"><i class="ft-inbox"></i></span></div>
                  <div class="col s9 recent-activity-list-text"><a href="#" class="grey-text medium-small">1 Year Ago</a>
                    <p class="mt-0 mb-2 fixed-line-height font-weight-300 medium-small">voice mail for conference.</p>
                  </div>
                </li>
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
              <div class="card-body">
                <div id='fc-default'></div>
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
<link rel="stylesheet" type="text/css" href="{{asset('app-assets')}}/vendors/css/fullcalendar.min.css">
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
<script src="{{ asset('app-assets') }}/vendors/js/moment.min.js" type="text/javascript"></script>
<script src="{{ asset('app-assets') }}/vendors/js/fullcalendar.min.js" type="text/javascript"></script>
<script src="{{ asset('app-assets') }}/vendors/js/jquery-ui.min.js" type="text/javascript"></script>
<script src="{{ asset('app-assets') }}/js/fullcalendar.js" type="text/javascript"></script>
@endsection