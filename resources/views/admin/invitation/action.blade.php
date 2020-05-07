@if(Auth::user()->role_id== 1)
<form method="POST" action="/admin/invitation/{{$dt->id}}">
<a href="{{ url('admin/invitation/'.$dt->id.'/edit') }}" class="success p-0" data-original-title="" title="">
        <i class="ft-edit-2 font-medium-3 mr-2"></i>
    </a>
{{ csrf_field() }}
{{ method_field('DELETE') }}
    <a class="danger p-0" onclick="if(confirm('Delete this item?')) this.closest('form').submit()">
        <i class="ft-x font-medium-3 mr-2"></i>
    </a>
</form>
@else
<a class="btn {{ ($dt->status == 'Unavailable') ? 'btn-outline-secondary':'btn-success white' }}" href="{{ url('admin/invitation/'.$dt->id.'/accept') }}" onclick="return confirm('Accept invitation?')"><i class="ft-thumbs-up"></i> Confirm</a>
<a class="btn {{ ($dt->status == 'Confirm') ? 'btn-outline-secondary':'btn-danger white' }}" href="{{ url('admin/invitation/'.$dt->id.'/reject') }}" onclick="return confirm('Reject invitation?')"><i class="ft-thumbs-down"></i> Unavailable</a>
@endif