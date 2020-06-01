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
  @if(Session::has('message'))
  <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ ucfirst(Session::get('message')) }}</p>
  @endif
      <div class="card profile-with-cover">
        <div class="card-img-top img-fluid bg-cover height-300" style="background: url('{{ asset('') }}app-assets/img/photos/14.jpg') 50%;"></div>
        <div class="media profil-cover-details row">
          <div class="col-5">
            <div class="align-self-start halfway-fab pl-3">
              <div class="text-left">
                <h3 class="card-title white">{{ Auth::user()->name }}</h3>
                <p class="card-title white"><i>@switch(Auth::user()->partner_status)
                @case('Active')
                Medin Partner
                @break
                @default
                {{ Auth::user()->partner_status }}
                @endswitch</i></p>
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
            <div class="form-group row">
              <label for="name" class="col-sm-2 col-form-label">Name</label>
              <div class="col-sm-10">
                <input type="text" name="name" class="form-control" id="inputname" disabled value="{{ Auth::user()->name }}">
              </div>
            </div>           
            <div class="form-group row">
              <label for="email" class="col-sm-2 col-form-label">Email</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" disabled id="inputemail" value="{{ Auth::user()->email }}">
              </div>
            </div>           
            <div class="form-group row">
              <label for="company" class="col-sm-2 col-form-label">Company</label>
              <div class="col-sm-10">
                <input type="text" name="company" class="form-control" disabled id="inputcompany" value="{{ Auth::user()->company }}">
              </div>
            </div>           
            <div class="form-group row">
              <label for="phone" class="col-sm-2 col-form-label">Phone</label>
              <div class="col-sm-10">
                <input type="text" name="phone" class="form-control" disabled id="inputphone" value="{{ Auth::user()->phone }}">
              </div>
            </div>           
            <div class="mb-3">
              <div id="txtabout" class="overflow-hidden">{!! nl2br(Auth::user()->about) !!}</div>
              <textarea id="inputabout" name="about" class="form-control" rows=3 style="display:none" placeholder="Tell something about you">{{ Auth::user()->about }}</textarea>
            </div>
            <div class="mb-3">
              @if(Auth::user()->partner_status == 'Active')
              <a id="btnstoppartner" href="{{ url('admin/stoppartner') }}" class="btn btn-warning" style="display:none" onclick="return confirm('Are you sure you want to stop being a Medin partner?')"><i class="ft-camera-off"></i> Stop Partnering</a>
              @endif
              @if(Auth::user()->status == 'Active')
              <a id="btndeactivate" href="{{ url('admin/deactivate') }}" class="btn btn-danger pull-right" style="display:none" onclick="return confirm('Are you sure you want to deactivate your account?')"><i class="ft-slash"></i> Deactivate Account</a>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--About section ends-->
</form>

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
              <span class="d-block overflow-hidden">
              <img src="{{ asset('images/history.jpg') }}" width="100%"/>
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
              <span class="d-block overflow-hidden">
              <img src="{{ asset('images/support.jpg') }}" width="100%"/>            
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
<style>
.title{
  margin-left: 10px;
}
#inputname, #inputphone, #inputcompany, #inputemail{
  background-color: transparent;
  border: none;
}
.inputborder{
  border: 1px solid #A6A9AE !important;
}
</style>
@endsection
@section('pagejs')
<script>
$(document).ready(function(){
  $("#btnedit").click(function(){
    $("#inputname").attr('disabled',false);    
    $("#inputname").addClass('inputborder');    
    $("#inputcompany").attr('disabled',false);    
    $("#inputcompany").addClass('inputborder');    
    $("#inputphone").attr('disabled',false);    
    $("#inputphone").addClass('inputborder');    
    $("#txtabout").hide();
    $("#inputabout").show();
    $("#btnsave").show();
    $("#btnedit").hide();
    $("#btndeactivate").show();
    $("#btnstoppartner").show();
  });
});
</script>
@endsection
