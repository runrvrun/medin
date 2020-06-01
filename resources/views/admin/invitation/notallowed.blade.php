@extends('admin.layouts.app')

@section('pagetitle')
    <title>Invitation</title>
@endsection

@section('content')
        <!-- BEGIN : Main Content-->
        <div class="main-content">
          <div class="content-wrapper">
<section id="browse-table">
  <div class="row">
    <div class="col-12">
      @if(Session::has('message'))
      <div class="alert {{ Session::get('alert-class', 'alert-info') }} alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {{ ucfirst(Session::get('message')) }}
      </div>
      @endif
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Invitation</h4>
        </div>
        <div class="card-content ">
          <div class="card-body card-dashboard table-responsive">
            <p>Only Partners can get invitation from Organizers</p>
            @if(Auth::user()->partner_status == '')
            <a href="/registerpartner" class="btn btn-primary">Join Now</a>
            @else
            <a href="/dashboard" class="btn btn-primary">Join Now</a>
            @endif
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
<div class="modal fade text-left show" id="invitation-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel8" style="display: none; padding-right: 17px;" aria-modal="true">
  <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary white">
        <h4 class="modal-title" id="myModalLabel8"><span id="event-type-modal">Invitation</span> for <span id="event-title-modal"></span></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endsection
@section('pagecss')
@endsection
@section('pagejs')
@endsection
