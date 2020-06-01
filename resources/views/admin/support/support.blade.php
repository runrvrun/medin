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
    <div class="col-sm-12">
      <div class="content-header">Support</div>
    </div>
  </div>
  @foreach($item as $val)
  <div class="row">
    <div class="col-12">      
      <div class="card">
        <div class="card-content ">
          <div class="card-body card-dashboard">
            <div class="row">
              <div class="col-md-12">
                <h4 class="card-title">{{ $val->title }}</h4>
                <p>{!! $val->description !!}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endforeach
</section>
<!-- File export table -->

          </div>
        </div>
@endsection
@section('pagecss')
<style>
.icon{
  text-align: center;
  color: #c9c9c9;
}
.date{
  font-size:10px;
  color: #c1c1c1;
}
</style>
@endsection
@section('pagejs')
@endsection
