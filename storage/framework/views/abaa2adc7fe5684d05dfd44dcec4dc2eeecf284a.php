<?php $__env->startSection('pagetitle'); ?>
    <title>Dashboard</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- BEGIN : Main Content-->
<div class="main-content">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-xl-3 col-lg-6 col-md-6 col-12">
        <div class="card gradient-blackberry">
          <div class="card-content">
            <div class="card-body pt-2 pb-0">
              <div class="media">
                <div class="media-body white text-left">
                  <h3 class="font-large-1 mb-0"><?php echo e($data['total_event']); ?></h3>
                  <span>Total Events</span>
                </div>
                <div class="media-right white text-right">
                  <i class="ft-monitor font-large-1"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-lg-6 col-md-6 col-12">
        <div class="card gradient-ibiza-sunset">
          <div class="card-content">
            <div class="card-body pt-2 pb-0">
              <div class="media">
                <div class="media-body white text-left">
                  <h3 class="font-large-1 mb-0"><?php echo e($data['total_invitation']); ?></h3>
                  <span>Total Invitations</span>
                </div>
                <div class="media-right white text-right">
                  <i class="ft-credit-card font-large-1"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php if(Auth::user()->role_id == 1): ?>
      <div class="col-xl-3 col-lg-6 col-md-6 col-12">
        <div class="card gradient-cosmic-fusion">
          <div class="card-content">
            <div class="card-body pt-2 pb-0">
              <div class="media">
                <div class="media-body white text-left">
                  <h3 class="font-large-1 mb-0"><?php echo e($data['total_user']); ?></h3>
                  <span>Total Users</span>
                </div>
                <div class="media-right white text-right">
                  <i class="ft-monitor font-large-1"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-lg-6 col-md-6 col-12">
        <div class="card gradient-love-couple">
          <div class="card-content">
            <div class="card-body pt-2 pb-0">
              <div class="media">
                <div class="media-body white text-left">
                  <h3 class="font-large-1 mb-0"><?php echo e($data['total_partner']); ?></h3>
                  <span>Total Partners</span>
                </div>
                <div class="media-right white text-right">
                  <i class="ft-credit-card font-large-1"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php else: ?>
      <div class="col-md-6">
      <?php switch(Auth::user()->partner_status):
          case ('Active'): ?>
              <button type="button" class="btn btn-primary btnjoin">Partnered</button>
              <?php break; ?>
          <?php case ('New'): ?>
              <button type="button" class="btn btnjoin new">Waiting for approval</button>
              <?php break; ?>
          <?php case ('Rejected'): ?>
              <a href="<?php echo e(url('registerpartner')); ?>">
                  <button type="button" class="btn btnjoin rejected">Rejected</button>
              </a>
              <?php break; ?>
          <?php case ('Inactive'): ?>
              <button type="button" class="btn btnjoin inactive">Inactive</button>
              <?php break; ?>
          <?php case ('Suspended'): ?>
              <button type="button" class="btn btnjoin suspended">Suspended</button>
              <?php break; ?>
          <?php default: ?>
          <a href="<?php echo e(url('admin/registerpartner')); ?>">
            <button type="button" class="btn btnjoin default">Join to be our partner</button>
          </a>
      <?php endswitch; ?>        
      </div>  
      <?php endif; ?>
    </div>
    <div class="row">
      <div class="col-sm-6">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Recent Activity</h4>
          </div>
          <div class="card-content">
            <div id="timeline" class="timeline-left timeline-wrapper ml-4 mt-3">
              <ul class="timeline">
                <li class="timeline-line"></li>
                <?php $__currentLoopData = $data['log']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="timeline-item">
                  <?php switch($val->tag):
                  case ('Event Invite'): ?>
                  <div class="timeline-badge"><span data-toggle="tooltip" data-placement="right" title="Event Invite" class="bg-info bg-lighten-1"><i class="ft-at-sign"></i></span></div>
                  <?php break; ?>
                  <?php case ('Event Approved'): ?>
                  <div class="timeline-badge"><span data-toggle="tooltip" data-placement="right" title="Event Approved" class="bg-success bg-lighten-1"><i class="ft-mic"></i></span></div>
                  <?php break; ?>
                  <?php case ('Event Rejected'): ?>
                  <div class="timeline-badge"><span data-toggle="tooltip" data-placement="right" title="Event Rejected" class="bg-danger bg-lighten-1"><i class="ft-mic-off"></i></span></div>
                  <?php break; ?>
                  <?php case ('Participant Confirm'): ?>
                  <div class="timeline-badge"><span data-toggle="tooltip" data-placement="right" title="Participant Confirm" class="bg-purple bg-lighten-1"><i class="ft-heart"></i></span></div>
                  <?php break; ?>
                  <?php default: ?>
                  <div class="timeline-badge"><span data-toggle="tooltip" data-placement="right" title="" class="bg-grey bg-lighten-1"><i class="ft-alert-circle"></i></span></div>
                  <?php endswitch; ?>
                  <div class="col s9 recent-activity-list-text"><a href="#" class="deep-purple-text medium-small"><?php echo e(\Carbon\Carbon::parse($val->created_at)->diffForHumans()); ?></a>
                    <?php if(Auth::user()->role_id==1): ?>
                    <div><small><i class="ft-user"></i> <?php echo e($val->name); ?> (<?php echo e($val->email); ?>)</small></div>
                    <?php endif; ?>
                    <p class="mt-0 mb-2 fixed-line-height font-weight-300 medium-small"><?php echo $val->detail; ?></p>
                  </div>
                </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="card">
          <div class="card-content">
          <div class="card">            
            <div class="card-content">
              <div class="card-body cal1">
                <div id="calendar"></div>
              </div>
            </div>
          </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('pagecss'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/clndr.css?v=5')); ?>">
<style>
.card-content{
  min-height: 100px;
}
.ct-series-a .ct-bar, .ct-series-a .ct-line, .ct-series-a .ct-point, .ct-series-a .ct-slice-donut {
    stroke: #0CC162;
}
.ct-series-b .ct-bar, .ct-series-b .ct-line, .ct-series-b .ct-point, .ct-series-b .ct-slice-donut {
    stroke: #33BFE0;
}
.ct-series-c .ct-bar, .ct-series-c .ct-line, .ct-series-c .ct-point, .ct-series-c .ct-slice-donut {
    stroke: #F6C41C;
}
table{
  min-width:100%;
}
.dt-body-right{
  text-align: right;
}
.btnjoin{
  position: relative;
  width: 100%;
  padding-right: 15px;
  padding-left: 15px;
  min-height: 100px;
  margin: 18px 0;
  color:white;
  font-size: 27px;
  font-weight: 100;
  border: none;
}
.btnjoin.default{
  background-color: #061ff9;
}
.btnjoin.default:hover{
  background-color: #0315b8;
  color: white;
}
.btnjoin.rejected, .btnjoin.suspended, .btnjoin.inactive{
  background-color: #f20d0d;
}
.btnjoin.rejected:hover{
  background-color: #d50b0b;
  color: white;
}
.btnjoin.suspended:hover, .btnjoin.inactive:hover{
  background-color: #f20d0d;
  color: white;
  cursor: auto;
}
.btnjoin.new{
  background-color: #ff8000;
}
.btnjoin.new:hover{
  background-color: #ff8000;
  color: white;
  cursor: auto;
}
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('pagejs'); ?>
<script src="<?php echo e(asset('js')); ?>/underscore-min.js" type="text/javascript"></script>
<script src="<?php echo e(asset('app-assets')); ?>/vendors/js/moment.min.js" type="text/javascript"></script>
<script>
var clndr = {};
$(document).ready(function(){  
  var events = [
    <?php $__currentLoopData = $data['event']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    { date: '<?php echo e(\Carbon\Carbon::parse($val->datetime)->format('Y-m-d')); ?>', shortdate: '<?php echo e(\Carbon\Carbon::parse($val->datetime)->format('d M')); ?>', title: '<?php echo e($val->event); ?>', location: '<?php echo e(strtoupper($val->address)); ?>, <?php echo e($val->cityprov); ?>', url: '<?php echo e(url("admin/invitation")); ?>' },
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  ];

  $('#calendar').clndr({
    events: events,
    forceSixRows: true
  });  
})
</script>
<script src="<?php echo e(asset('js')); ?>/clndr.js?v=2" type="text/javascript"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\medin\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>