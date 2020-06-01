<span style="white-space:nowrap">
<a href="{{ url('admin/user/partner/review/'.$dt->id) }}" class="success p-0" data-original-title="" title="">
        <i class="ft-edit-2 font-medium-3 mr-2"></i>
    </a>
@if(!empty($dt->id_photo))    
<a href="{{ asset($dt->id_photo) }}" data-toggle="lightbox" class="info p-0" data-max-width="600" title="View ID"><i class="ft-credit-card font-medium-3 mr-2"></i></a>    
@endif
@if(!empty($dt->company_id_photo))    
<a href="{{ asset($dt->company_id_photo) }}" data-toggle="lightbox" class="danger p-0" data-max-width="600" title="View Company ID"><i class="ft-speaker font-medium-3 mr-2"></i></a>    
@endif
</span>