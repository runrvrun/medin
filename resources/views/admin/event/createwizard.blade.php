@extends('admin.layouts.app')

@section('pagetitle')
    <title>{{ isset($item)? 'Edit':'Add'}} Event</title>
@endsection

@section('content')
        <!-- BEGIN : Main Content-->
<div class="main-content">
  <div class="content-wrapper"><!-- DOM - jQuery event table -->
    <section id="icon-tabs">
      <div class="row">
        <div class="col-12">
        @if ($errors->any())
        <p class="alert alert-danger">
          {!! ucfirst(implode('<br/>', $errors->all(':message'))) !!}
        </p>
        @endif
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">{{ isset($item)? 'Edit':'Add'}} Event</h4>
            </div>
            <div class="card-content">
              <div class="card-body">
                @if(isset($item))
                  <form id="create-form" method="POST" action="{{ url('admin/event/'.$item->id.'/updatewizard') }}" class="icons-tab-steps wizard-circle">
                  <input name="_method" type="hidden" value="PATCH">
                  @csrf
                @else
                  <form id="create-form" method="POST" action="{{ url('admin/event/storewizard') }}" class="icons-tab-steps wizard-circle">
                @endif
                  @csrf
                  <!-- Step 1 -->
                  <h6>EVENT INFORMATION</h6>
                  <fieldset>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="firstName2">Event Name</label>
                          {{ Form::text('event', old('event',$item->event ?? null), array('class' => 'form-control','required')) }}
                        </div>
                        <div class="form-group">
                          <label for="date2">Date and Time</label>
                          <div class='input-group'>
                            {{ Form::text('date', old('date',\Carbon\Carbon::parse($item->datetime ?? now())->format('l, d M Y')), array('class' => 'form-control pickadate','required')) }}
                            <div class="input-group-append">
                              <span class="input-group-text">
                                <span class="fa fa-calendar-o"></span>
                              </span>
                            </div>
                          </div>
                          <div class="input-group">                        
                            {{ Form::text('time', old('time',\Carbon\Carbon::parse($item->datetime ?? now())->format('g:i A')), array('class' => 'form-control pickatime','required')) }}
                            <div class="input-group-append">
                              <span class="input-group-text">
                                <span class="ft-clock"></span>
                              </span>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="description">Event Description</label>
                          {{ Form::textarea('description', old('description',$item->description ?? null), array('class' => 'form-control','rows'=>5)) }}
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="city_id">Location</label>
                          {{ Form::select('city_id',$cityprov,old('city_id',$item->city_id ?? 0),['placeholder'=>'Select city','class'=>'form-control']) }}
                        </div>
                        <div class="form-group">
                          <label for="address">Address</label>
                          {{ Form::textarea('address', old('address',$item->address ?? null), array('class' => 'form-control','rows'=>5,'required')) }}
                        </div>
                        @if(Auth::user()->role_id == 1)                
                        <div class="form-group">
                          <label for="address">Create as User</label>
                          {{ Form::select('user_id',\App\User::pluck('name','id'),old('user_id',$item->user_id ?? Auth::user()->id),['class'=>'form-control']) }}
                        </div>
                        @endif
                      </div>  
                    </div>
                  </fieldset>
                  <h6>MEDIA INVITATION</h6>
                  <fieldset>
                    <!-- search -->                    
                    <div class="row" id="search-media">
                      <div class="input-group row">
                        <div class="col-sm-3">
                          <input id="search" type="text" class="form-control" placeholder="Search media partner">
                        </div>
                        <div class="col-sm-2">
                          <span class="input-group-btn">
                              <button id="btnsearch" class="btn btn-primary" type="button"><span class="ft-search"></span> Search</button>
                          </span>
                        </div>
                      </div>
                      <div class="input-group row">
                        <div class="col-sm-12">
                          <div class="btn-group quick-filter-media-type" role="group">
                            <input type="hidden" name="quick-filter-media-type" />
                            <button type="button" class="btn btn-primary">All</button>
                            <button type="button" class="btn btn-outline-primary">TV</button>
                            <button type="button" class="btn btn-outline-primary">Radio</button>
                            <button type="button" class="btn btn-outline-primary">Online</button>
                            <button type="button" class="btn btn-outline-primary">Print</button>
                            <button type="button" class="btn btn-outline-primary">Blogger</button>
                            <button type="button" class="btn btn-outline-primary">YouTuber</button>
                            <button type="button" class="btn btn-outline-primary">Selebgram</button>
                            <button type="button" class="btn btn-outline-primary">Influencer</button>
                            <button type="button" class="btn btn-outline-primary">Others</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      @if(!empty($invitation))
                      <input type="hidden" name="selected-media-container" value="{{ json_encode(explode(',',$invites->invites_id ?? null)) }}"/>
                      @else
                      <input type="hidden" name="selected-media-container" value="[]"/>
                      @endif
                      <div id="selected-media-container">  
                        @if(!empty($invitation->items))
                          @foreach($invitation as $key=>$val)
                          <div class="media-div" id="{{ $val->id }}"><button type="button" class="media-item btn btn-primary"><p class="company">{{ $val->media }}</p><p class="media-type">{{ $val->media_type }}</p><span class="image"><img src="{{ asset($val->avatar) }}"></span><p class="name">{{ $val->name }}</p></button></div>
                          @endforeach
                        @endif
                      </div>
                    </div>
                      <!-- search result -->
                    <div class="row">
                      <div id="media-container" class="media-container">    
                      </div>
                    </div>
                  </fieldset>
                  <h6>CONFIRMATION</h6>
                  <fieldset>
                  <ul class="list-group">
                    <li class="list-group-item">
                      <div class="row">
                        <div class="col-2 offset-1">Event Name</div>
                        <div class="col-8 confirman" id="confirm-event">{{ $item->event ?? old('event',$item->event ?? null) }}</div>
                      </div>
                    </li>
                    <li class="list-group-item">
                      <div class="row">
                        <div class="col-2 offset-1">Date and time</div>
                        <div class="col-8 confirman"><span  id="confirm-date">{{ \Carbon\Carbon::parse($item->datetime ?? null)->format('l, d M Y g:i A') }}</span> <span  id="confirm-time"></span></div>
                      </div>
                    </li>
                    <li class="list-group-item">
                      <div class="row">
                        <div class="col-2 offset-1">Description</div>
                        <div class="col-8 confirman" id="confirm-description">{{ $item->description ?? null }}</div>
                      </div>
                    </li>
                    <li class="list-group-item">
                      <div class="row">
                        <div class="col-2 offset-1">Location</div>
                        <div class="col-8 confirman" id="confirm-city_id">{{ $item->cityprov ?? null }}</div>
                      </div>
                    </li>
                    <li class="list-group-item">
                      <div class="row">
                        <div class="col-2 offset-1">Address</div>
                        <div class="col-8 confirman" id="confirm-address">{{ $item->address ?? null }}</div>
                      </div>                
                    </li>
                  </ul>
                  <h4>Invitation</h4>
                    <div id="confirm-invitation" class="row">    
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
<link rel="stylesheet" type="text/css" href="{{ asset('slick') }}/slick.css"/>
<link rel="stylesheet" type="text/css" href="{{ asset('slick') }}/slick-theme.css"/>
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
  width: 96%;
  margin: 0 2%;
  /* max-height: 233px;
  overflow-x: auto;
  overflow-y: hidden; */
}
.btn.media-item{
  width: 186px;
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
.media-item .image img{
  margin: 3px;
  max-width: 100%;
}
.media-item .name, .media-item .company{
  overflow:hidden;
  white-space: nowrap;
}
.company{
  font-size: 12px;
  margin-bottom:0;
}
.media-type{
  font-size: 10px;
  color: #cfcfcf;
}
#search-media input{
  width: 252px;
}
#search-media{
  margin: 20px 0 10px 12px;
}
#search-media .input-group-btn{
  margin-left:20px;
}
.confirman::before{
  content: ": ";
}
.quick-filter-media-type button{
  font-size:12px;
}
.slick-prev:before, .slick-next:before{
  color: #fc8003;
}
.slick-slide img{
  display: inline;
}
#selected-media-container>div.media-div{
  display:inline;
}
#confirm-invitation>.media-div{
  margin-bottom:10px;
}
</style>
@endsection
@section('pagejs')
<script src="{{ asset('app-assets') }}/js/bootstrap-select.min.js"></script>
<script src="{{ asset('app-assets') }}/vendors/js/jquery.steps.min.js" type="text/javascript"></script>
<script src="{{ asset('app-assets') }}/vendors/js/pickadate/picker.js" type="text/javascript"></script>
<script src="{{ asset('app-assets') }}/vendors/js/pickadate/picker.date.js" type="text/javascript"></script>
<script src="{{ asset('app-assets') }}/vendors/js/pickadate/picker.time.js" type="text/javascript"></script>
<script src="{{ asset('app-assets') }}/vendors/js/pickadate/legacy.js" type="text/javascript"></script>
<script src="{{ asset('app-assets') }}/vendors/js/jquery.validate.min.js" type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('slick') }}/slick.min.js"></script>
<script>
  // wizard steps
  $(document).ready( function(){
    $(".icons-tab-steps").steps({
        headerTag: "h6",
        bodyTag: "fieldset",
        transitionEffect: "fade",
        titleTemplate: '<span class="step step#index#">#index#</span> #title#',
        labels: {
          @if(isset($item))
            finish: 'Update'
          @else
            finish: 'Submit'
          @endif
        },
        onStepChanged: function (event, currentIndex, priorIndex)
        {
            if (currentIndex === 1)
            {
              loadpartner();
            }            
        },
        onFinished: function (event, currentIndex) {
          @if(isset($item))
            if(confirm('Updating an event will reset all invitation status. Proceed?')){
              $("#create-form").submit();
            }
          @else
            $("#create-form").submit();
          @endif
        }
    });

    // To select event date
    $('.pickadate').pickadate({
        format: 'dddd, dd mmm yyyy'
    })
  });
  // update confirmation screen content
  $(document).ready(function(){
    $("input[name=event]").change(function(){
      $("#confirm-event").html($(this).val());
    });
    $("input[name=date]").change(function(){
      $("#confirm-date").html($(this).val());
    });
    $("input[name=time]").change(function(){
      $("#confirm-time").html($(this).val());
    });
    $("textarea[name=description]").change(function(){
      $("#confirm-description").html($(this).val());
    });
    $("select[name=city_id]").change(function(){
      $("#confirm-city_id").html($(this).find("option:selected").text());
    });
    $("textarea[name=address]").change(function(){
      $("#confirm-address").html($(this).val());
    });
    $('body').on('DOMSubtreeModified', '#selected-media-container', function(){
      $("#confirm-invitation").html($(this).html());
    });
  });
  //
  $(document).ready(function(){
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
    
    $(".quick-filter-media-type").find("button").click(function(){      
      $("input[name=quick-filter-media-type]").val($(this).text());      
      $('body').find('#btnsearch').click();
      $(".quick-filter-media-type").children().attr('class','btn btn-outline-primary');
      $(this).attr('class','btn btn-primary');
    })   
  });
  
  // search // use delegate from body because originally was hidden and js won't run on hidden
  function slickinit(){
    $('#media-container').not('.slick-initialized').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        infinite:false,
        arrows: true
    });
  };
  function loadpartner(){
    slickinit();
    $.ajax({
      url: "{{ url('admin/user/getpartners') }}", 
      data: {
        keyword: $('#search').val(),
        mediatype: $('input[name=quick-filter-media-type]').val(),
        // exclude: $('input[name=selected-media-container]').val()
        exclude: ''
      }, 
      success: function(result){
        if(result.length){
          var excl = $.parseJSON($('input[name=selected-media-container]').val());
          // if in excl, add to selected media container
          $.each(result, function(k, v) {
            if($.inArray(v.id.toString(),excl) > -1){
              $('#selected-media-container').append('<div class="media-div" id="'+v.id+'"><button type="button" class="media-item btn btn-primary"><p class="company">'+v.media+'</p><p class="media-type">'+v.media_type+'</p><span class="image"><img src="{{ asset('/') }}'+v.avatar+'"></span><p class="name">'+v.name+'</p></button></div>');
            }else{
              $('#media-container').slick('slickAdd','<div class="media-div" id="'+v.id+'"><button type="button" class="media-item btn btn-primary"><p class="company">'+v.media+'</p><p class="media-type">'+v.media_type+'</p><span class="image"><img src="{{ asset('/') }}'+v.avatar+'"></span><p class="name">'+v.name+'</p></button></div>');
            }
          });
        }else{
          $('#media-container').html('<p>No result found.</p>');
        }
      }
    });
  }

  $('body').on('keypress','#search',function(e) {
    if(e.which == 13) {
      $('#btnsearch').click();
    }
  });
  $('body').on('click','#btnsearch',function(){
      $('#media-container').slick('unslick');
      loadpartner();
  });
  // click result, add to selected  
  $('body').on('click','#media-container .media-div',function(){
    if($('#selected-media-container').html().indexOf('Search')>0){
      var selmed = [];
      $('#selected-media-container').empty();
    }else{
      var selmed = $('input[name=selected-media-container]').val();
      selmed = JSON.parse(selmed);
    }
    selmed.push($(this).attr('id'));
    $('input[name=selected-media-container]').val(JSON.stringify(selmed));
    $('#media-container').slick('unslick');
    $(this).appendTo($('#selected-media-container'));
    slickinit();
  });
  // click selected, return to result
  $('body').on('click','#selected-media-container .media-div',function(){
    var value = $('input[name=selected-media-container]').val();
    value = JSON.parse(value);
    index = value.indexOf($(this).attr('id'));
    if (index > -1) {
      value.splice(index, 1);
    }
    $('input[name=selected-media-container]').val(JSON.stringify(value));
    $('#media-container').slick('unslick');
    $(this).appendTo($('#media-container'));
    slickinit();
  });
</script>
<script>
  $(document).ready(function(){
	  $('.pickatime').pickatime();
  });
</script>
@endsection
