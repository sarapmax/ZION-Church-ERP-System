<a href="javascript:void(0);" class="{{ $type == 'button' ? 'btn btn-white' : '' }}" onclick="$(this).find('form').submit();" >
    <i class="far fa-trash-alt"></i>
    <form action="{{ $route }}" method="POST" onsubmit="return confirm('Are you sure to delete this?')">
        @csrf
        {{ method_field('DELETE') }}
    </form>
</a>
