@extends('admin.layouts.app')

@section('pagetitle')
    <title>Add Announcement</title>
@endsection

@section('content')
        <!-- BEGIN : Main Content-->
        <div class="main-content">
          <div class="content-wrapper"><!-- DOM - jQuery announcement table -->
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
          <h4 class="card-title">Add Announcement</h4>
        </div>
        <div class="card-content">
        <div class="px-3">
          @if(isset($item))
              {{ Form::model($item, ['route' => ['announcement.update', $item->id], 'method' => 'patch']) }}
          @else
              {{ Form::open(['route' => 'announcement.store']) }}
          @endif
          <div class="form-body">
          <div class="form-group row">
            <label class="col-md-3 label-control" for="title">Title</label>
            <div class="col-md-9">
            {{ Form::text('title', old('title',$item->title ?? null), array('class' => 'form-control','required')) }}
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-3 label-control" for="description">Announcement</label>
							<div class="mx-auto col-md-9">
              {{ Form::textarea('description', old('description',$item->description ?? null), array('class' => 'form-control','id'=>'editor')) }}
							</div>
						</div>
          </div>
          <div class="form-actions">
            <a class="pull-right" href="{{ route('announcement.index') }}"><button type="button" class="btn btn-raised btn-warning mr-1">
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
<link rel="stylesheet" href="{{ asset('app-assets') }}/css/bootstrap-select.min.css">
@endsection
@section('pagejs')
<script src="{{ asset('app-assets') }}/js/bootstrap-select.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/19.0.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
<script>
  $(document).ready(function(){
    $("select[name='province_id']").change();
    // dropdown search with bootstrap select
    $("select[name='province_id']").attr('data-live-search','true');
    $("select[name='province_id']").attr('data-size','4');
    $("select[name='province_id']").selectpicker();
    $("select[name='city_id']").addClass('selectpicker');
    $("select[name='city_id']").attr('data-live-search','true');
    $("select[name='city_id']").attr('data-size','4');
    $("select[name='city_id']").selectpicker();
    $("select[name='user_id']").addClass('selectpicker');
    $("select[name='user_id']").attr('data-live-search','true');
    $("select[name='user_id']").attr('data-size','4');
    $("select[name='user_id']").selectpicker();

  });
  
  // make city dropdown conditional to province
  $("select[name='province_id']").change(function () {
    var opt = $("option:selected", this);
    var val = this.value;
    $("select[name='city_id'] option").hide();
    $("select[name='city_id'] option[value^='"+ val +"']").show();
    $("select[name='city_id'] option[value^='"+ val +"']:first").attr('selected','selected');
    $("select[name='city_id']").attr('data-live-search','true');
    $("select[name='city_id']").attr('data-size','4');
    $("select[name='city_id']").selectpicker('refresh');
  });  
</script>
@endsection
