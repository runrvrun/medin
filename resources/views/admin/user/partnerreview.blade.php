@extends('admin.layouts.app')

@section('pagetitle')
    <title>Partner Review</title>
@endsection

@section('content')
        <!-- BEGIN : Main Content-->
        <div class="main-content">
          <div class="content-wrapper"><!-- DOM - jQuery events table -->
<section id="browse-table">
  <div class="row">
    <div class="col-sm-12">
      <div class="content-header">Partner</div>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-content">
          <div class="px-3 form">
            {{ Form::model($item, ['route' => ['user.update', $item->id], 'method' => 'patch']) }}          
            {{ Form::hidden('partnerreview',1) }}
            <div class="row">
              <div class="col-md-2">
                <button type='button' class='media-item btn btn-primary'><div class='image'><img src='{{ asset($item->avatar) }}' style="width:100%"></div><div class='name'>{{ $item->name }}</div><div class='company'><small>[{{ $item->media_type }}] {{ $item->media }}</small></div></button>
              </div>
              <div class="col-md-10">              
                <h4 class="form-section" style="margin-top:25px"><i class="ft-user"></i> Personal Info</h4>
                <div class="form-body">
                  <div class="form-group row">
                    <label class="col-md-3 label-control" for="date">Name: </label>
                    <div class="col-md-9">
                    {{ $item->name }}
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-3 label-control" for="date">Phone: </label>
                    <div class="col-md-9">
                    {{ $item->phone }}
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-3 label-control" for="date">Email: </label>
                    <div class="col-md-9">
                    {{ $item->email }}
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-3 label-control" for="date">NIK: </label>
                    <div class="col-md-9">
                    {{ $item->id_no }}
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-3 label-control" for="date"></label>
                    <div class="col-md-9">
                      <img src="{{ asset($item->id_photo) }}" height="200px" />
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-3 label-control" for="date">Location: </label>
                    <div class="col-md-9">
                      {{ $item->cityprov }}
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-3 label-control" for="date">Address: </label>
                    <div class="col-md-9">
                    {{ $item->address }}
                    </div>
                  </div>
                  <hr>
                  <h4 class="form-section"><i class="ft-briefcase"></i> Company Info</h4>
                  <div class="form-group row">
                    <label class="col-md-3 label-control" for="date">Media: </label>
                    <div class="col-md-9">
                    {{ $item->media }}
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-3 label-control" for="date">Media Type: </label>
                    <div class="col-md-9">
                    {{ $item->media_type }}
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-3 label-control" for="date">Company Address: </label>
                    <div class="col-md-9">
                    {{ $item->company_address }}
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-3 label-control" for="date"></label>
                    <div class="col-md-9">
                      <img src="{{ asset($item->company_id_photo) }}" height="200px" />
                    </div>
                  </div>
                </div>
                <div class="form-actions">
                  <button type="submit" name="approve" value=1 class="pull-left btn btn-raised btn-success mr-3">
                    <i class="fa fa-check-square-o"></i> Approve
                  </button>         
                  <button type="submit" name="reject" value=1 class="pull-left btn btn-raised btn-danger mr-3">
                    <i class="ft-x-square"></i> Reject
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
<style>
button.media-item{
  margin: 25px 0;
}
</style>
@endsection
@section('pagejs')
@endsection
