@extends('admin.layouts.app')

@section('pagetitle')
    <title>Add News</title>
@endsection

@section('content')
        <!-- BEGIN : Main Content-->
        <div class="main-content">
          <div class="content-wrapper"><!-- DOM - jQuery news table -->
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
          <h4 class="card-title">Add News</h4>
        </div>
        <div class="card-content">
        <div class="px-3">
          @if(isset($item))
              {{ Form::model($item, ['route' => ['news.update', $item->id], 'method' => 'patch','enctype'=>'multipart/form-data']) }}
          @else
              {{ Form::open(['route' => 'news.store','enctype'=>'multipart/form-data']) }}
          @endif
          <div class="form-body">
          <div class="form-group row">
            <label class="col-md-3 label-control" for="title">Title</label>
            <div class="col-md-9">
            {{ Form::text('title', old('title',$item->title ?? null), array('class' => 'form-control','required')) }}
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-3 label-control" for="content">Content</label>
							<div class="mx-auto col-md-9">
              {{ Form::textarea('content', old('content',$item->content ?? null), array('class' => 'form-control','id'=>'editor')) }}
							</div>
						</div>
          </div>
          <div class="form-group row">
            <label class="col-md-3 label-control" for="title">Thumbnail</label>
            <div class="col-md-9">
            {{ Form::file('featured_image', array('class' => 'form-control')) }}
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-3 label-control" for="title">Images</label>
            <div class="col-md-9">
            {{ Form::file('images[]', array('class' => 'form-control', 'multiple'=>'multiple')) }}
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
@endsection
@section('pagejs')
<script src="https://cdn.ckeditor.com/ckeditor5/19.0.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
@endsection
