@extends('admin.layouts.app')

@section('pagetitle')
    <title>Thank you</title>
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
      <div class="card">
        <div class="card-content" style="min-height: 200px;margin: 80px;">
          Thank you for applying to be our partner. Our officer will check your data and will inform you soon.
          <br>
          <br>
          <a href="{{ url('/admin') }}" class="btn btn-success"> Back to Dashboard</a>
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
@endsection
@section('pagejs')
@endsection
