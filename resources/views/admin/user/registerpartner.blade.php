@extends('admin.layouts.app')

@section('pagetitle')
    <title>Partner Registration</title>
@endsection

@section('content')
        <!-- BEGIN : Main Content-->
        <div class="main-content">
          <div class="content-wrapper"><!-- DOM - jQuery events table -->
<section id="browse-table">
  <div class="row">
    <div class="col-sm-12">
      <div class="content-header">Register as Partner</div>
      <p class="content-sub-header">Be our partner and enjoy exclusive invitations to our events.</p>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      @if ($errors->any())
      <p class="alert alert-danger">
        {!! ucfirst(implode('<br/>', $errors->all(':message'))) !!}
      </p>
      @endif
      <div class="card">
        <div class="card-content">
          <div class="px-3 form">
            {{ Form::model(Auth::user(), ['route' => ['user.update', Auth::user()->id], 'method' => 'patch','enctype'=>'multipart/form-data']) }}          
            {{ Form::hidden('registerpartner',1) }}
            {{ Form::hidden('partner_status','New') }}
            <div class="row">
              <div class="col-md-2">
                <button type='button' class='media-item btn btn-primary'><div class='image'><img src='{{ asset(Auth::user()->avatar) }}' style="width:100%"></div><div class='name'>{{ Auth::user()->name }}</div><div class='company'><small>[{{ Auth::user()->media_type }}] {{ Auth::user()->media }}</small></div></button>
              </div>
              <div class="col-md-10">              
                <h4 class="form-section" style="margin-top:25px"><i class="ft-user"></i> Personal Info</h4>
                <div class="form-body">
                  <div class="form-group row">
                    <label class="col-md-3 label-control" for="date">Name: </label>
                    <div class="col-md-9">
                    {{ Form::text('name', Auth::user()->name, array('class' => 'form-control', 'required')) }}
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-3 label-control" for="date">Phone: </label>
                    <div class="col-md-9">
                    {{ Form::text('phone', Auth::user()->phone, array('class' => 'form-control', 'required')) }}
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-3 label-control" for="date">Email: </label>
                    <div class="col-md-9">
                    {{ Form::text('email', Auth::user()->email, array('disabled','class' => 'form-control', 'required')) }}
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-3 label-control" for="date">Photo: </label>
                    <div class="col-md-9">
                    {{ Form::file('avatar', array('class' => 'form-control', 'required')) }}
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-3 label-control" for="date">NIK: </label>
                    <div class="col-md-9">
                    {{ Form::text('id_no', Auth::user()->id_no, array('class' => 'form-control', 'required')) }}
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-3 label-control" for="date">Upload NIK: </label>
                    <div class="col-md-9">
                    {{ Form::file('id_photo', array('class' => 'form-control', 'required')) }}
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-3 label-control" for="date">Location: </label>
                    <div class="col-md-9">
                    {{ Form::select('city_id', $cityprov, Auth::user()->city_id, array('class' => 'form-control', 'required')) }}
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-3 label-control" for="date">Address: </label>
                    <div class="col-md-9">
                    {{ Form::textarea('address', Auth::user()->address, array('class' => 'form-control', 'required','rows'=>3)) }}
                    </div>
                  </div>
                  <hr>
                  <h4 class="form-section"><i class="ft-briefcase"></i> Company Info</h4>
                  <div class="form-group row">
                    <label class="col-md-3 label-control" for="date">Media: </label>
                    <div class="col-md-9">
                    {{ Form::text('media', Auth::user()->media, array('class' => 'form-control', 'required')) }}
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-3 label-control" for="date">Media Type: </label>
                    <div class="col-md-9">
                    {{ Form::text('media_type', Auth::user()->media_type, array('class' => 'form-control', 'required')) }}
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-3 label-control" for="date">Company Address: </label>
                    <div class="col-md-9">
                    {{ Form::textarea('company_address', Auth::user()->media, array('class' => 'form-control', 'required','rows'=>3)) }}
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-3 label-control" for="date">Upload Company ID Card: </label>
                    <div class="col-md-9">
                    {{ Form::file('company_id_photo', array('class' => 'form-control', 'required')) }}
                    </div>
                  </div>
                  <hr>
                </div>
                <div class="form-actions">
                  <a class="pull-right" href="{{ url('admin/user') }}"><button type="button" class="btn btn-raised btn-warning mr-1">
                    <i class="ft-x"></i> Cancel
                  </button></a>
                  <button type="submit" class="pull-left btn btn-raised btn-primary mr-3">
                    <i class="fa fa-check-square-o"></i> Apply as Partner
                  </button>         
                </div>
              </div>
            </div>
            </form>
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
@endsection
@section('pagecss')
<link rel="stylesheet" href="{{ asset('app-assets') }}/css/bootstrap-select.min.css">
<style>
button.media-item{
  margin: 25px 0;
}
</style>
@endsection
@section('pagejs')
<script src="{{ asset('app-assets') }}/js/bootstrap-select.min.js"></script>
<script>
$(document).ready(function(){
    $("select[name='city_id']").addClass('selectpicker');
    $("select[name='city_id']").attr('data-live-search','true');
    $("select[name='city_id']").attr('data-size','4');
    $("select[name='city_id']").selectpicker();
});
</script>
@endsection
