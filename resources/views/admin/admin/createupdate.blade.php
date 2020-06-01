@extends('admin.layouts.app')

@section('pagetitle')
    <title>Administrator</title>
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
        <div class="card-header">
          <h4 class="card-title">{{ isset($item)? 'Edit':'Add' }} Admin</h4>
        </div>
        <div class="card-content">
          <div class="px-3 form">
          @if(isset($item))
              {{ Form::model($item, ['route' => ['admin.update', $item->id], 'method' => 'patch','enctype'=>'multipart/form-data']) }}          
          @else
              {{ Form::open(['route' => 'admin.store']) }}
          @endif
          <div class="row">
              <div class="col-md-12">              
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
                </div>
                <div class="form-actions">
                  <a class="pull-right" href="{{ url('admin/admin') }}"><button type="button" class="btn btn-raised btn-warning mr-1">
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
