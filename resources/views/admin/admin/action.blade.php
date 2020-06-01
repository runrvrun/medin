<form method="POST" action="{{ url('admin/admin/'.$dt->id) }}" style="white-space:nowrap">
{{ csrf_field() }}
{{ method_field('DELETE') }}
<a href="{{ url('admin/admin/'.$dt->id.'/edit') }}" class="success p-0" data-original-title="" title="">
        <i class="ft-edit-2 font-medium-3 mr-2"></i>
    </a>
    <a class="danger p-0" onclick="if(confirm('Remove this admin?')) this.closest('form').submit()">
        <i class="ft-x font-medium-3 mr-2"></i>
    </a>
</form>