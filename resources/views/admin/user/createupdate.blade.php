@extends('admin.layouts.app')

@section('pagetitle')
    <title>User</title>
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
        <div class="card-content">
          <div class="px-3 form">
          @if(isset($item))
              {{ Form::model($item, ['url' => 'admin/user/'.$item->id.'/update', 'method' => 'patch']) }}
          @else
              {{ Form::open(['url' => 'admin/user/store']) }}
          @endif
             <h4 class="form-section"><i class="ft-user"></i> Personal Info</h4>
              <div class="form-body">
                <div class="form-group row">
                  <label class="col-md-3 label-control" for="date">Name: </label>
                  <div class="col-md-9">
                  {{ Form::text('name', old('name',$item->name ?? null), array('class' => 'form-control','required')) }}
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-3 label-control" for="date">Email: </label>
                  <div class="col-md-9">
                  {{ Form::email('email', old('date',$item->email ?? null), array('class' => 'form-control','required')) }}
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-3 label-control" for="date">Company: </label>
                  <div class="col-md-9">
                  {{ Form::text('company', old('company',$item->company ?? null), array('class' => 'form-control')) }}
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-3 label-control" for="date">Phone: </label>
                  <div class="col-md-9">
                  {{ Form::text('phone', old('phone',$item->phone ?? null), array('class' => 'form-control')) }}
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-3 label-control" for="channel">Role: </label>
                  <div class="col-md-9">
                  {{ Form::select('role', 
                    ['Admin'=>'Admin','Agency'=>'Agency','TV Station'=>'TV Station','Advertiser'=>'Advertiser','Trial'=>'Trial'], 
                    old('channel',$item->channel ?? null), 
                    array('class' => 'form-control')) }}
                  </div>
                </div>    
                <div class="form-group row">
                  <label class="col-md-3 label-control" for="date">Password: </label>
                  <div class="col-md-9">
                  {{ Form::password('password', array('class' => 'form-control','placeholder'=>'leave empty to keep password')) }}
                  </div>
                </div>
               <h4 class="form-section"><i class="ft-unlock"></i> Commercial Privileges</h4>
                <div class="form-group row">
                  <label class="col-md-3 label-control" for="date">Target Audience: </label>
                  <div class="col-md-9">
                    {{ Form::text('privileges[targetaudience]', old('privileges[targetaudience]',$item->privileges->targetaudience ?? null), array('class' => 'form-control filter-button', 'data-title'=>'Target Audience', 'data-filter'=>'targetaudience','placeholder'=>'all')) }}
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-3 label-control" for="date">nSector: </label>
                  <div class="col-md-9">
                    {{ Form::text('privileges[nsector]', old('privileges[nsector]',$item->privileges->nsector ?? null), array('class' => 'form-control filter-button', 'data-title'=>'Sector', 'data-filter'=>'nsector','placeholder'=>'all')) }}
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-3 label-control" for="date">iSector: </label>
                  <div class="col-md-9">
                    {{ Form::text('privileges[isector]', old('privileges[isector]',$item->privileges->isector ?? null), array('class' => 'form-control filter-button', 'data-title'=>'iSector', 'data-filter'=>'isector','placeholder'=>'all')) }}
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-3 label-control" for="date">nCategory: </label>
                  <div class="col-md-9">
                    {{ Form::text('privileges[ncategory]', old('privileges[ncategory]',$item->privileges->ncategory ?? null), array('class' => 'form-control filter-button', 'data-title'=>'nCategory', 'data-filter'=>'ncategory','placeholder'=>'all')) }}
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-3 label-control" for="date">iCategory: </label>
                  <div class="col-md-9">
                    {{ Form::text('privileges[icategory]', old('privileges[icategory]',$item->privileges->icategory ?? null), array('class' => 'form-control filter-button', 'data-title'=>'iCategory', 'data-filter'=>'icategory','placeholder'=>'all')) }}
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-3 label-control" for="date">nAdvertiser: </label>
                  <div class="col-md-9">
                    {{ Form::text('privileges[nadvertiser]', old('privileges[nadvertiser]',$item->privileges->nadvertiser ?? null), array('class' => 'form-control filter-button', 'data-title'=>'nAdvertiser', 'data-filter'=>'nadvertiser','placeholder'=>'all')) }}
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-3 label-control" for="date">iAdvertiser: </label>
                  <div class="col-md-9">
                    {{ Form::text('privileges[iadvertiser]', old('privileges[iadvertiser]',$item->privileges->iadvertiser ?? null), array('class' => 'form-control filter-button', 'data-title'=>'iAdvertiser', 'data-filter'=>'iadvertiser','placeholder'=>'all')) }}
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-3 label-control" for="date">Advertiser Group: </label>
                  <div class="col-md-9">
                    {{ Form::text('privileges[iadvertiser_group]', old('privileges[iadvertiser_group]',$item->privileges->iadvertiser_group ?? null), array('class' => 'form-control filter-button', 'data-title'=>'Advertiser Group', 'data-filter'=>'iadvertiser_group','placeholder'=>'all')) }}
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-3 label-control" for="date">nProduct: </label>
                  <div class="col-md-9">
                    {{ Form::text('privileges[nproduct]', old('privileges[nproduct]',$item->privileges->nproduct ?? null), array('class' => 'form-control filter-button', 'data-title'=>'nProduct', 'data-filter'=>'nproduct','placeholder'=>'all')) }}
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-3 label-control" for="date">iProduct: </label>
                  <div class="col-md-9">
                    {{ Form::text('privileges[iproduct]', old('privileges[iproduct]',$item->privileges->iproduct ?? null), array('class' => 'form-control filter-button', 'data-title'=>'iProduct', 'data-filter'=>'iproduct','placeholder'=>'all')) }}
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-3 label-control" for="date">nCopy: </label>
                  <div class="col-md-9">
                    {{ Form::text('privileges[ncopy]', old('privileges[ncopy]',$item->privileges->ncopy ?? null), array('class' => 'form-control filter-button', 'data-title'=>'nCopy', 'data-filter'=>'ncopy','placeholder'=>'all')) }}
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-3 label-control" for="date">iCopy: </label>
                  <div class="col-md-9">
                    {{ Form::text('privileges[icopy]', old('privileges[icopy]',$item->privileges->icopy ?? null), array('class' => 'form-control filter-button', 'data-title'=>'iCopy', 'data-filter'=>'icopy','placeholder'=>'all')) }}
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-3 label-control" for="date">nAds Type: </label>
                  <div class="col-md-9">
                    {{ Form::text('privileges[nadstype]', old('privileges[nadstype]',$item->privileges->nadstype ?? null), array('class' => 'form-control filter-button', 'data-title'=>'nAds Type', 'data-filter'=>'nadstype','placeholder'=>'all')) }}
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-3 label-control" for="date">iAds Type: </label>
                  <div class="col-md-9">
                    {{ Form::text('privileges[iadstype]', old('privileges[iadstype]',$item->privileges->iadstype ?? null), array('class' => 'form-control filter-button', 'data-title'=>'iAds Type', 'data-filter'=>'iadstype','placeholder'=>'all')) }}
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-3 label-control" for="date">tAds Type: </label>
                  <div class="col-md-9">
                    {{ Form::text('privileges[tadstype]', old('privileges[tadstype]',$item->privileges->tadstype ?? null), array('class' => 'form-control filter-button', 'data-title'=>'tAds Type', 'data-filter'=>'tadstype','placeholder'=>'all')) }}
                  </div>
                </div>
                <h4 class="form-section"><i class="ft-unlock"></i> Channel Privileges</h4>
                <div class="form-group row">
                  <label class="col-md-3 label-control" for="date">Channel: </label>
                  <div class="col-md-9">
                    {{ Form::text('privileges[channel]', old('privileges[channel]',$item->privileges->channel ?? null), array('class' => 'form-control filter-button', 'data-title'=>'Channel', 'data-filter'=>'channel','placeholder'=>'all')) }}
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-3 label-control" for="date">nLevel 1: </label>
                  <div class="col-md-9">
                    {{ Form::text('privileges[nlevel_1]', old('privileges[nlevel_1]',$item->privileges->nlevel_1 ?? null), array('class' => 'form-control filter-button', 'data-title'=>'nLevel 1', 'data-filter'=>'nlevel_1','placeholder'=>'all')) }}
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-3 label-control" for="date">iLevel 1: </label>
                  <div class="col-md-9">
                    {{ Form::text('privileges[ilevel_1]', old('privileges[ilevel_1]',$item->privileges->ilevel_1 ?? null), array('class' => 'form-control filter-button', 'data-title'=>'iLevel 1', 'data-filter'=>'ilevel_1','placeholder'=>'all')) }}
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-3 label-control" for="date">nLevel 2: </label>
                  <div class="col-md-9">
                    {{ Form::text('privileges[nlevel_2]', old('privileges[nlevel_2]',$item->privileges->nlevel_2 ?? null), array('class' => 'form-control filter-button', 'data-title'=>'nLevel 2', 'data-filter'=>'nlevel_2','placeholder'=>'all')) }}
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-3 label-control" for="date">iLevel 2: </label>
                  <div class="col-md-9">
                    {{ Form::text('privileges[ilevel_2]', old('privileges[ilevel_2]',$item->privileges->ilevel_2 ?? null), array('class' => 'form-control filter-button', 'data-title'=>'iLevel 2', 'data-filter'=>'ilevel_2','placeholder'=>'all')) }}
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-3 label-control" for="date">nProgramme: </label>
                  <div class="col-md-9">
                    {{ Form::text('privileges[nprogramme]', old('privileges[nprogramme]',$item->privileges->nprogramme ?? null), array('class' => 'form-control filter-button', 'data-title'=>'nProgramme', 'data-filter'=>'nprogramme','placeholder'=>'all')) }}
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-3 label-control" for="date">iProgramme: </label>
                  <div class="col-md-9">
                    {{ Form::text('privileges[iprogramme]', old('privileges[iprogramme]',$item->privileges->iprogramme ?? null), array('class' => 'form-control filter-button', 'data-title'=>'iProgramme', 'data-filter'=>'iprogramme','placeholder'=>'all')) }}
                  </div>
                </div>
                <h4 class="form-section"><i class="ft-unlock"></i> Other Privileges</h4>
                <div class="form-group row">
                  <label class="col-md-3 label-control" for="date">Data Period: </label>
                  <div class="col-md-9">
                    <div id="daterange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc;">
                        <i class="fa fa-calendar"></i>&nbsp;
                        <span></span> <i class="fa fa-caret-down"></i>
                        {{ Form::hidden('privileges[startdate]',old('privileges[startdate]',$item->privileges->startdate ?? null),['id'=>'startdate']) }}
                        {{ Form::hidden('privileges[enddate]',old('privileges[enddate]',$item->privileges->enddate ?? null),['id'=>'enddate']) }}
                    </div>            
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-3 label-control" for="date">Status: </label>
                  <div class="col-md-9">
                    <div class="custom-control custom-switch">
                      @if(isset($item->status))
                      <input type="checkbox" class="custom-control-input" id="status" name="status" {{ ($item->status)? "checked":"" }}>
                      @else
                      <input type="checkbox" class="custom-control-input" id="status" name="status" checked>
                      @endif
                      <label class="custom-control-label" for="status" id="status_text">Active</label>
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-3 label-control" for="date">Access  Time: </label>
                  <div class="col-md-9">                  
                    @if(isset($item->expired_at))
                    {{ Form::text('expired_at', old('expired_at',$item->expired_at->format('d/m/Y')), array('class' => 'form-control datepicker-here','autocomplete'=>'off', 'data-language'=>'id')) }}
                    @else
                    {{ Form::text('expired_at', old('expired_at','31/12/2099'), array('class' => 'form-control datepicker-here','autocomplete'=>'off', 'data-language'=>'id')) }}
                    @endif
                  </div>
                </div>
              </div>
              <div class="form-actions">
                <a class="pull-right" href="{{ url('admin/user') }}"><button type="button" class="btn btn-raised btn-warning mr-1">
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
@section('modal')
<div class="modal fade text-left show" id="filter-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel8" style="display: none; padding-right: 17px;" aria-modal="true">
  <div class="modal-dialog  modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary white">
        <h4 class="modal-title" id="myModalLabel8"><span id="filter-title"></span> Privileges</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="filter-active"></input>
        <div class="input-group row">
          <div class="col-sm-4">
            <input id="search-term" type="text" class="form-control" placeholder="Cari">
          </div>
            <span class="input-group-btn">
                <button id="search-button" class="btn btn-primary" type="button"><span class="ft-search"></span> Cari</button>
            </span>
        </div>
        <div id="filter-modal-search-result" style="height:250px; overflow-y:scroll">
        </div>
      </div>
      <div class="modal-footer">
        <div id="filter-selected"></div>
        <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Set Privilege</button>
        <a id="filter-reset-selected" class="btn btn-secondary pull-left" style="color:#fff"><i class="ft-rotate-ccw"></i></a>
      </div>
    </div>
  </div>
</div>
@endsection
@section('pagecss')
<link href="{{ asset('css') }}/datepicker.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endsection
@section('pagejs')
<script src="{{ asset('js') }}/datepicker.min.js"></script>
<script src="{{ asset('js') }}/i18n/datepicker.id.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script type="text/javascript">
$(function() {
    @if(isset($item->privileges['startdate']))
      var start = moment('{{$item->privileges['startdate']}}');
      $('input[name="privileges[startdate]"]').val(start.format('YYYY-MM-DD'));
      var end = moment('{{$item->privileges['enddate']}}'); 
      $('input[name="privileges[enddate]"]').val(end.format('YYYY-MM-DD'));
    @else
      var start = moment('2016-01-01');
      $('input[name="privileges[startdate]"]').val(start.format('YYYY-MM-DD'));
      var end = moment('2099-12-31'); 
      $('input[name="privileges[enddate]"]').val(end.format('YYYY-MM-DD'));
    @endif

    function cb(start, end) {
        $('#daterange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    }

    $('#daterange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
           'Hari ini': [moment(), moment()],
           'Kemarin': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           '7 Hari': [moment().subtract(6, 'days'), moment()],
           '30 Hari': [moment().subtract(29, 'days'), moment()],
           'Bulan Ini': [moment().startOf('month'), moment().endOf('month')],
           'Bulan Lalu': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);

    cb(start, end);

    $('#daterange').on('apply.daterangepicker', function(ev, picker) {
      daterange = $('#daterange').data('daterangepicker');
      $('#startdate').val(daterange.startDate.format('YYYY-MM-DD'));
      $('#enddate').val(daterange.endDate.format('YYYY-MM-DD'));
    });
});
</script>
<script type="text/javascript">
$(document).ready(function(){
  $(".filter-button").click(function(){
    var filter = $(this).data("filter");
    $("#filter-title").html($(this).data("title"));
    $("input[name=filter-active]").val(filter);
    $("#filter-modal-search-result").empty();
    $('#search-term').val('');
    $("#filter-modal").modal();
    // show existing filter in modal footer
    $("#filter-selected").html('');
    $("#filter-selected").html($('input[name="privileges['+filter+']"]').val());
    // load directly
      $("#search-button").click();
  });
  $('#search-term').keypress(function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
          $('#search-button').click();
        }
  });
  $("#search-button").click(function(){
    var filter = $("input[name=filter-active]").val();
    $("#filter-modal-search-result").empty();
    var term = $('#search-term').val();
    // get and show search result
    $.ajax({
      url: "{{ url('/admin/adsperformance') }}/search-"+filter+"-json", 
      data: {term: term}, 
      success: function(result){
        if(result.length){
          $.each(result, function(k,v) {
            var curfil = $("#filter-selected").html().replace(/&amp;/g, '&');;            
            if(!$("#filter-"+filter).is(':empty') && curfil.indexOf(v[filter] + ';')+1){
              // previously selected, set style
              $('#filter-modal-search-result').append( '<button class="btn search-result btn-primary mr-1" value="'+v[filter]+'">'+v[filter]+'</button>' );
            }else{
              $('#filter-modal-search-result').append( '<button class="btn search-result btn-outline-primary mr-1" value="'+v[filter]+'">'+v[filter]+'</button>' );
            }
          });
        }else{
          $('#filter-modal-search-result').html('<p>No result found</p>');
        }
    }});      
  }); 
  $("#filter-modal-search-result").on('click', '.search-result', function() {
    var filter = $("input[name=filter-active]").val();
    count = $("#filter-"+filter+"-count").html(); // get initial button count
    $(this).toggleClass("btn-outline-primary");
    $(this).toggleClass("btn-primary"); 
    var filt = $(this).val();
    if($(this).hasClass('btn-primary')){
      count++; // selected, increment button count
      $("#filter-selected").html(function(i,html) { 
        html = html + filt + ';';
        return html;
      });
    }else{
      count--; // unselected, decrement button count
      newval = $("#filter-selected").html().replace(/&amp;/g, '&');
      $("#filter-selected").html(newval.replace(filt+';',''));
    }
    $('input[name="privileges['+filter+']"]').val($("#filter-selected").html());
    $("#filter-"+filter+"-count").html(count); // set count at button
  });
  $("#filter-reset-selected").click(function(){
      var filter = $("input[name=filter-active]").val();
      $(".search-result.btn-primary").addClass("btn-outline-primary");
      $(".search-result.btn-primary").removeClass("btn-primary");    
      $("#filter-selected").html('');
      $('input[name="privileges['+filter+']"]').val('');
      $("#filter-"+filter+"-count").html(''); // set count at button
    });
});
</script>
@endsection
