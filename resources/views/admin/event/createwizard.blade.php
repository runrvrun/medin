@extends('admin.layouts.app')

@section('pagetitle')
    <title>Add Event</title>
@endsection

@section('content')
        <!-- BEGIN : Main Content-->
        <div class="main-content">
          <div class="content-wrapper"><!-- DOM - jQuery event table -->
          <section id="icon-tabs">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Create Event</h4>
        </div>
        <div class="card-content">
          <div class="card-body">
            <form class="icons-tab-steps wizard-circle">
              <!-- Step 1 -->
              <h6>EVENT INFORMATION</h6>
              <fieldset>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="firstName2">Event Name</label>
                      <input type="text" class="form-control" id="event" name="event">
                    </div>
                    <div class="form-group">
                      <label for="date2">Date and Time</label>
                      <div class='input-group'>
                        <input type='text' class="form-control pickadate" placeholder="Select date" name="date" />
                        <div class="input-group-append">
                          <span class="input-group-text">
                            <span class="fa fa-calendar-o"></span>
                          </span>
                        </div>
                      </div>
                      <div class="input-group">                        
                        <input type='text' class="form-control pickatime" placeholder="Select time" />
                        <div class="input-group-append">
                          <span class="input-group-text">
                            <span class="ft-clock"></span>
                          </span>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="description">Event Description</label>
                      <textarea class="form-control" id="description" name="description" rows=5></textarea>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="city_id">Location</label>
                      {{ Form::select('city_id',$cityprov,null,['placeholder'=>'Select city','class'=>'form-control']) }}
                    </div>
                    <div class="form-group">
                      <label for="address">Address</label>
                      <textarea class="form-control" id="address" name="address" rows=5></textarea>
                    </div>
                  </div>                  
                </div>
              </fieldset>
              <!-- Step 2 -->
              <h6>MEDIA INVITATION</h6>
              <fieldset>
                <div class="row">
                  <input type="hidden" name="selected-media-container"/>
                  <div id="selected-media-container">     
                    <span class="selected-media-container-placeholder">Search below to start</span>
                  </div>
                </div>
                <!-- search -->
                <div class="row" id="search-media">
                  <div class="input-group row">
                    <div class="col-sm-4">
                      <input id="search" type="text" class="form-control" placeholder="Search media partner">
                    </div>
                      <span class="input-group-btn">
                          <button id="btnsearch" class="btn btn-primary" type="button"><span class="ft-search"></span> Search</button>
                      </span>
                  </div>
                </div>
                  <!-- search result -->
                <div class="row">
                  <div id="media-container">                    
                  </div>
                </div>
              </fieldset>
              <!-- Step 3 -->
              <h6>CONFIRMATION</h6>
              <fieldset>
                
              </fieldset>              
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
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets') }}/vendors/css/wizard.css">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets') }}/vendors/css/pickadate/pickadate.css">
<style>
#selected-media-container{
  min-height: 212px;
  border: 1px solid #008080;
  border-radius: 4px;
  width: 100%;
  padding:10px;
  white-space: nowrap;
  overflow-x: auto;
}
#media-container{
  padding: 10px;
  max-height: 650px;
  width: 100%;
  overflow-y: auto;
}
.btn.media-item{
  padding:5px;
  width: 154px;
  margin-bottom: 0;
  margin-right: 10px;
}
#media-container .btn.media-item{
  margin-bottom: 12px;
}
#selected-media-container .btn.media-item::before{
  content: "×";
  font-size:
  color: #5d5d5d;
}
#media-container .btn.media-item::before{
  content: "×";
  color: transparent;
}
.media-item small{
  margin: 0 3px;
}
.media-item .image img{
  border-radius: 50%;
  margin: 3px 0;
}
.media-item .name, .media-item .company{
  overflow:hidden;
  white-space: nowrap;
}
#search-media input{
  width: 314px;
}
#search-media{
  margin: 20px 0 10px 12px;
}
#search-media .input-group-btn{
  margin-left:20px;
}
.selected-media-container-placeholder{
  color: #cecece;
  position: relative;
  left: 42%;
  top: 39%;
}
</style>
@endsection
@section('pagejs')
<script src="{{ asset('app-assets') }}/js/bootstrap-select.min.js"></script>
<script src="{{ asset('app-assets') }}/vendors/js/jquery.steps.min.js" type="text/javascript"></script>
<script src="{{ asset('app-assets') }}/js/wizard-steps.js?v=1" type="text/javascript"></script>
<script src="{{ asset('app-assets') }}/vendors/js/pickadate/picker.js" type="text/javascript"></script>
<script src="{{ asset('app-assets') }}/vendors/js/pickadate/picker.date.js" type="text/javascript"></script>
<script src="{{ asset('app-assets') }}/vendors/js/pickadate/picker.time.js" type="text/javascript"></script>
<script src="{{ asset('app-assets') }}/vendors/js/pickadate/legacy.js" type="text/javascript"></script>
<script src="{{ asset('app-assets') }}/vendors/js/jquery.validate.min.js" type="text/javascript"></script>
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
    
    // change step icon
    $(".step1").html('<i class="ft-calendar"></i>');
    $(".step2").html('<i class="ft-briefcase"></i>');
    $(".step3").html('<i class="ft-check-circle"></i>');
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

  // search // use delegate from body because originally was hidden and js won't run on hidden  
  $('body').on('keypress','#search',function(e) {
    if(e.which == 13) {
      $('#btnsearch').click();
    }
  });
  $('body').on('click','#btnsearch',function(){
    if($('#search').val().length>2){
      $('#media-container').empty();
      $.ajax({
        url: "{{ url('admin/user/getpartners') }}", 
        data: {keyword: $('#search').val()}, 
        success: function(result){
          if(result.length){
            $.each(result, function(k, v) {
              $('#media-container').append("<button id='"+v.id+"' type='button' class='media-item btn btn-primary'><div class='image'><img src='{{ asset('/') }}/"+v.avatar+"'></div><div class='name'>"+v.name+"</div><div class='company'><small>["+v.media_type+"] "+v.media+"</small></div></button>");
            });
          }else{
            $('#media-container').html('<p>No result found</p>');
          }
        }
      });
    }
  });
  // click result, add to selected  
  $('body').on('click','#media-container .media-item',function(){
    if($('#selected-media-container').html().indexOf('Search below to start')>0){
      var selmed = [];
      $('#selected-media-container').empty();
    }else{
      var selmed = $('input[name=selected-media-container]').val();
      selmed = JSON.parse(selmed);
    }
    selmed.push($(this).attr('id'));
    $('input[name=selected-media-container]').val(JSON.stringify(selmed));
    $(this).appendTo($('#selected-media-container'));
  });
  // click selected, return to result
  $('body').on('click','#selected-media-container .media-item',function(){
    var value = $('input[name=selected-media-container]').val();
    value = JSON.parse(value);
    index = value.indexOf($(this).attr('id'));
    if (index > -1) {
      value.splice(index, 1);
    }
    $('input[name=selected-media-container]').val(JSON.stringify(value));
    $(this).appendTo($('#media-container'));
  });
</script>
<script>
  $(document).ready(function(){
	  $('.pickatime').pickatime();
  });
</script>
@endsection
