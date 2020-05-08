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
  @if(Session::has('message'))
  <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ ucfirst(Session::get('message')) }}</p>
  @endif  
  @if ($errors->any())
  <p class="alert alert-danger">
    {!! ucfirst(implode('<br/>', $errors->all(':message'))) !!}
  </p>
  @endif  
  @foreach($item as $val)
  <div class="row">
    <div class="col-12">  
      <div class="card">
        <div class="card-content ">
          <div class="card-body card-dashboard">
            <div class="row">
              <div class="col-md-12">
                <h4 class="card-title">{{ $val->title }}</h4>
                {{ Form::model($val, ['route' => ['support.update', $val->id], 'method' => 'patch']) }}
                <textarea name="description" id="support{{ $val->id }}">{{ $val->description }}</textarea>
                <div class="pull-right" style="margin-top:5px">
                <button type="submit" class="btn btn-primary"><i class="ft-save"></i> Save</button>
                </div>
                </form>
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
<script src="https://cdn.ckeditor.com/ckeditor5/19.0.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create( document.querySelector( '#support1' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
<script>
    ClassicEditor
        .create( document.querySelector( '#support2' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
<script>
    ClassicEditor
        .create( document.querySelector( '#support3' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
@endsection
