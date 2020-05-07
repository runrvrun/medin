@if($dt->partner_status == 'New')
<a href="{{ url('admin/user/partner/review/'.$dt->id) }}" class="btn btn-info">Review</a>
@endif