<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="os-icon os-icon-signs-11"></i><span>Logout</span></a>

<form id="logout-form" action="{{ route('logout') }}" method="POST"
      style="display: none;">
    {{ csrf_field() }}
</form>
