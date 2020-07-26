@extends('admin.layouts.app')

@section('pagetitle')
    <title>Notification</title>
@endsection

@section('content')
        <!-- BEGIN : Main Content-->
        <div class="main-content">
          <div class="content-wrapper"><!-- DOM - jQuery events table -->
<section id="browse-table">
  <div class="row">
    <div class="col-12">
      <div class="card">
      @if ($errors->any())
              <p class="alert alert-danger">
              {!! ucfirst(implode('<br/>', $errors->all(':message'))) !!}
              </p>
      @endif
        <div class="card-header">
          <h4 class="card-title">Notification</h4>
        </div>
        <div class="card-content">
          <div class="px-3">
          @if(isset($item))
              {{ Form::model($item, ['url' => 'admin/notification/'.$item->id, 'method' => 'patch', 'files' => true]) }}
          @else
              {{ Form::open(['url' => 'admin/notification', 'files' => true]) }}
          @endif
              <div class="form-body">
                <div class="form-group row">
                  <label class="col-md-3 label-control" for="date">Title: </label>
                  <div class="col-md-9">
                  {{ Form::text('title', old('title',$item->data->title ?? null), array('class' => 'form-control','required','autocomplete'=>'off')) }}
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-3 label-control" for="channel">Notification: </label>
                  <div class="col-md-9">
                  {{ Form::textarea('message', old('title',$item->data->message ?? null), array('class' => 'form-control','required','rows'=>5)) }}
                  </div>
                </div>                                    
              </div>
              <div class="form-actions">
                <a class="pull-right" href="{{ url('admin/notification') }}"><button type="button" class="btn btn-raised btn-warning mr-1">
                  <i class="ft-x"></i> Cancel
                </button></a>
                <button type="submit" class="pull-left btn btn-raised btn-primary mr-3">
                  <i class="fa fa-check-square-o"></i> Save
                </button>         
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
@section('pagecss')
@endsection
@section('pagejs')
@endsection
