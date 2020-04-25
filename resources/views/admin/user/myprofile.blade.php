@extends('admin.layouts.app')

@section('pagetitle')
    <title>My Profile</title>
@endsection

@section('content')
        <!-- BEGIN : Main Content-->
        <div class="main-content">
          <div class="content-wrapper"><!--User Profile Starts-->
<!--Basic User Details Starts-->
<form method="POST" action="updateprofile" enctype="multipart/form-data">
@csrf
<section id="user-profile">
  <div class="row">
    <div class="col-12">
      <div class="card profile-with-cover">
        <div class="card-img-top img-fluid bg-cover height-300" style="background: url('{{ asset('') }}app-assets/img/photos/14.jpg') 50%;"></div>
        <div class="media profil-cover-details row">
          <div class="col-5">
            <div class="align-self-start halfway-fab pl-3">
              <div class="text-left">
                <h3 id="txtname" class="card-title white">{{ Auth::user()->name }}</h3>
                <p id="txttitle" class="card-title white">{{ Auth::user()->title }}</p>
                <input id="inputname" type="text" name="name" class="form-control" style="display:none" value="{{ Auth::user()->name }}"></input>
                <input id="inputtitle" type="text" name="title" class="form-control" style="display:none" value="{{ Auth::user()->title }}"></input>
              </div>
            </div>
          </div>
          <div class="col-2">
            <div class="align-self-center halfway-fab text-center circle">
                <img src="{{ asset('') }}app-assets/img/portrait/avatars/avatar-08.png" class="rounded-circle img-border gradient-summer width-100 profile-pic" alt="Card image">
            </div>
          </div>
          <div class="col-5">
          </div>
          <div class="profile-cover-buttons">
            <div class="media-body halfway-fab align-self-end">
              <div class="text-right d-none d-sm-none d-md-none d-lg-block">
                <button id="btnsave" type="submit" class="btn btn-warning btn-raised mr-2" style="display:none"><i class="fa fa-save"></i> Save</button>
                <button id="btnedit" type="button" class="btn btn-primary btn-raised mr-2"><i class="fa fa-edit"></i> Edit</button>
              </div>
              <div class="text-right d-block d-sm-block d-md-block d-lg-none">
                <button type="button" class="btn btn-primary btn-raised mr-2"><i class="fa fa-plus"></i></button>
                <button type="button" class="btn btn-success btn-raised mr-3"><i class="fa fa-dashcube"></i></button>
              </div>
            </div>
          </div>
        </div>
        <div class="profile-section">
          <div class="row">
            <div class="col-lg-5 col-md-5 ">
              <ul class="profile-menu no-list-style">
                <li>
                  <a href="#about" class="primary font-medium-2 font-weight-600">About</a>
                </li>
                <li>
                  <a href="#privileges" class="primary font-medium-2 font-weight-600">Privileges</a>
                </li>
              </ul>
            </div>
            <div class="col-lg-2 col-md-2 text-center">
            </div>
            <div class="col-lg-5 col-md-5">
              <ul class="profile-menu no-list-style">
                <li>
                  <a href="#history" class="primary font-medium-2 font-weight-600">History</a>
                </li>
                <li>
                  <a href="#support" class="primary font-medium-2 font-weight-600">Support</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--Basic User Details Ends-->

<!--About section starts-->
<section id="about">
  <div class="row">
    <div class="col-12">
      <div class="content-header">About</div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-content">
          <div class="card-body">
            <div class="mb-3">
              <div id="txtabout" class="overflow-hidden">{!! nl2br(Auth::user()->about) !!}</div>
              <textarea id="inputabout" name="about" class="form-control" rows=3 style="display:none">{{ Auth::user()->about }}</textarea>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--About section ends-->
</form>

<section id="privileges">
  <div class="row">
    <div class="col-12">
      <div class="content-header">Privileges</div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-content">
          <div class="card-body">
            <div class="mb-3">
              <span class="d-block overflow-hidden">
              @if(!empty(Auth::user()->privileges))
              @foreach(Auth::user()->privileges as $key=>$val)
                <div class="row">
                  @if($key == 'isostartdate' || $key == 'isoenddate'  || $key == 'enddate')
                    @php continue @endphp
                  @endif                  
                  @if($key == 'startdate')
                  <div class="col-2"><strong>Data period</strong></div>
                  <div class="col-10">{{ \Carbon\Carbon::createFromFormat('Y-m-d',str_replace(',','',$val))->format('d M Y') }} - {{ \Carbon\Carbon::createFromFormat('Y-m-d',str_replace(',','',Auth::user()->privileges['enddate']))->format('d M Y') }}</div>
                  @else
                  <div class="col-2"><strong>{{ ucwords($key) }}</strong></div>
                  <div class="col-10">{{ ucwords($val ?? "All") }}</div>
                  @endif
                </div>
              @endforeach
              @endif
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!--User's friend section starts-->
<section id="history">
  <div class="row">
    <div class="col-12">
      <div class="content-header">History</div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-content">
          <div class="card-body">
            <div class="mb-3">
              <span class="d-block overflow-hidden">Coming soon...
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--User's friend section starts-->

<!--User's uploaded photos section starts-->
<section id="support">
  <div class="row">
    <div class="col-12">
      <div class="content-header">Support</div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-content">
          <div class="card-body">
            <div class="mb-3">
              <span class="d-block overflow-hidden">Coming soon...
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--User's uploaded photos section starts-->
<!--User Profile Starts-->

          </div>
        </div>
@endsection
@section('pagecss')
@endsection
@section('pagejs')
<script>
$(document).ready(function(){
  $("#btnedit").click(function(){
    $("#btnsave").show();
    $("#inputname").show();
    $("#inputtitle").show();
    $("#inputabout").show();  
    $(".upload-button").show();
    $("#btnedit").hide();  
    $("#txtname").hide();  
    $("#txttitle").hide();  
    $("#txtabout").hide();  
  });
  $("#btnsave").click(function(){
    $("#btnsave").hide();  
    $("#inputname").hide();
    $("#inputtitle").hide();
    $("#inputabout").hide();  
    $(".upload-button").hide();
    $("#btnedit").show(); 
    $("#txtname").show();  
    $("#txttitle").show();
    $("#txtabout").show();  
  });
});
</script>
@endsection
