<form method="POST" action="/admin/event/<?php echo e($dt->id); ?>" style="white-space:nowrap">
<a class="btnparticipant" data-eventid="<?php echo e($dt->id); ?>" data-event="<?php echo e($dt->event); ?>"><i class="ft-users font-medium-3 mr-2"></i><span class="action-badge notification badge badge-pill badge-info"><?php echo e($dt->participant ?? 0); ?></span></a>
<a class="btninvitation" data-eventid="<?php echo e($dt->id); ?>" data-event="<?php echo e($dt->event); ?>"><i class="ft-mail font-medium-3 mr-2"></i><span class="action-badge notification badge badge-pill badge-info"><?php echo e($dt->invitation ?? 0); ?></span></a>
<?php if(Auth::user()->role_id==1): ?>
<!-- <a href="<?php echo e(url('admin/event/'.$dt->id.'/edit')); ?>" class="success p-0" data-original-title="" title="">
        <i class="ft-edit-2 font-medium-3 mr-2"></i>
    </a> -->
<?php endif; ?>
<a href="<?php echo e(url('admin/event/'.$dt->id.'/editwizard')); ?>" class="success p-0" data-original-title="" title="Edit Wizard">
    <i class="ft-edit font-medium-3 mr-2"></i>
</a>
<?php if(Auth::user()->role_id==1): ?>
<?php echo e(csrf_field()); ?>

<?php echo e(method_field('DELETE')); ?>

    <a class="danger p-0" onclick="if(confirm('Delete this item?')) this.closest('form').submit()">
        <i class="ft-x font-medium-3 mr-2"></i>
    </a>
<?php endif; ?>
<!-- <a href="<?php echo e(url('admin/event/'.$dt->id.'/cancel')); ?>" class="danger p-0" data-original-title="" title="Cancel">
    <i class="ft-slash font-medium-3 mr-2"></i>
</a>     -->
</form>
<?php if(Auth::user()->role_id==1 && $dt->status == 'New'): ?>
<!-- <a href="<?php echo e(url('admin/event/'.$dt->id.'/approve')); ?>" class="btn btn-success">Approve</a> -->
<!-- <a href="<?php echo e(url('admin/event/'.$dt->id.'/reject')); ?>" class="btn btn-danger">Reject</a> -->
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\medin\resources\views/admin/event/action.blade.php ENDPATH**/ ?>