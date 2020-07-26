@extends('admin.layouts.app')

@section('pagetitle')
    <title>User</title>
@endsection

@section('content')
        <!-- BEGIN : Main Content-->
        <div class="main-content">
          <div class="content-wrapper"><!-- DOM - jQuery events table -->
<section id="browse-table">
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
          @if(isset($item))
              {{ Form::model($item, ['route' => ['user.update', $item->id], 'method' => 'patch','enctype'=>'multipart/form-data']) }}          
          @else
              {{ Form::open(['route' => 'user.store']) }}
          @endif
          <div class="row">
              <div class="col-md-2">
                @if(isset($item))
                <button type='button' class='media-item btn btn-primary'><div class='image'><img src='{{ asset($item->avatar??'uploads/avatar/default.jpg') }}' style="width:100%"></div><div class='name'>{{ $item->name??null }}</div><div class='company'><small>[{{ $item->media_type??null }}] {{ $item->media??null }}</small></div></button>
                @endif
              </div>
              <div class="col-md-10">              
                <h4 class="form-section" style="margin-top:25px"><i class="ft-user"></i> Personal Info</h4>
                <div class="form-body">
                  <div class="form-group row">
                    <label class="col-md-3 label-control" for="date">Name: </label>
                    <div class="col-md-9">
                    {{ Form::text('name', old('name',$item->name??null), array('class' => 'form-control','required')) }}
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-3 label-control" for="date">Phone: </label>
                    <div class="col-md-9">
                    {{ Form::text('phone', old('phone',$item->phone??null), array('class' => 'form-control')) }}
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-3 label-control" for="date">Email: </label>
                    <div class="col-md-9">
                    @if(isset($item))
                    {{ Form::text('email', old('email',$item->email??null), array('disabled','class' => 'form-control')) }}
                    @else
                    {{ Form::text('email', old('email',$item->email??null), array('class' => 'form-control','required')) }}
                    </div>
                    </div>
                    <div class="form-group row">
                    <label class="col-md-3 label-control" for="date">Password: </label>
                    <div class="col-md-9">
                    {{ Form::password('password', array('class' => 'form-control','required')) }}
                    @endif
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-3 label-control" for="date">Photo: </label>
                    <div class="col-md-9">
                    {{ Form::file('avatar', array('class' => 'form-control')) }}
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-3 label-control" for="date">NIK: </label>
                    <div class="col-md-9">
                    {{ Form::text('id_no', old('id_no',$item->id_no??null), array('class' => 'form-control')) }}
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-3 label-control" for="date">Upload NIK: </label>
                    <div class="col-md-9">
                    {{ Form::file('id_photo', array('class' => 'form-control')) }}
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-3 label-control" for="date">Location: </label>
                    <div class="col-md-9">
                    {{ Form::select('city_id', $cityprov, $item->city_id??null, array('class' => 'form-control')) }}
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-3 label-control" for="date">Address: </label>
                    <div class="col-md-9">
                    {{ Form::textarea('address', old('address',$item->address??null), array('class' => 'form-control','rows'=>3)) }}
                    </div>
                  </div>
                  <hr>
                  <h4 class="form-section"><i class="ft-briefcase"></i> Company Info</h4>
                  <div class="form-group row">
                    <label class="col-md-3 label-control" for="date">Media: </label>
                    <div class="col-md-9">
                    {{ Form::text('media', old('media',$item->media??null), array('class' => 'form-control')) }}
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-3 label-control" for="date">Media Type: </label>
                    <div class="col-md-9">
                    {{ Form::text('media_type', old('media_type',$item->media_type??null), array('class' => 'form-control')) }}
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-3 label-control" for="date">Company Address: </label>
                    <div class="col-md-9">
                    {{ Form::textarea('company_address', old('company_address',$item->company_address??null), array('class' => 'form-control','rows'=>3)) }}
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-3 label-control" for="date">Upload Company ID Card: </label>
                    <div class="col-md-9">
                    {{ Form::file('company_id_photo', array('class' => 'form-control')) }}
                    </div>
                  </div>
                  <hr>
                </div>
                <div class="form-actions">
                  <a class="pull-right" href="{{ url('admin/user') }}"><button type="button" class="btn btn-raised btn-warning mr-1">
                    <i class="ft-x"></i> Cancel
                  </button></a>
                  <button type="submit" class="pull-left btn btn-raised btn-primary mr-3">
                    <i class="fa fa-check-square-o"></i> Save
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
@endsection
