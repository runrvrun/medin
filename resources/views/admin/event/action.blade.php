<form method="POST" action="/admin/event/{{$dt->id}}" style="white-space:nowrap">
<a href="{{ url('admin/event/participant?id='.$dt->id) }}"><i class="ft-users font-medium-3 mr-2"></i><span class="action-badge notification badge badge-pill badge-info">11</span></a>
<a href="{{ url('admin/event/invitation?id='.$dt->id) }}"><i class="ft-mail font-medium-3 mr-2"></i><span class="action-badge notification badge badge-pill badge-info">11</span></a>
<a href="{{ url('admin/event/'.$dt->id.'/edit') }}" class="success p-0" data-original-title="" title="">
        <i class="ft-edit-2 font-medium-3 mr-2"></i>
    </a>
{{ csrf_field() }}
{{ method_field('DELETE') }}
    <a class="danger p-0" onclick="if(confirm('Delete this item?')) this.closest('form').submit()">
        <i class="ft-x font-medium-3 mr-2"></i>
    </a>
</form>