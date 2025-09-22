<div class="dropdown">
    <button type="button" class="btn border-0 rounded-circle p-0" data-bs-toggle="dropdown" aria-expanded="true">
        @php $imgerror = env('APP_URL').'/assets/media/avatar.jpg'; @endphp
        <img src="{{Auth::user()->imagen}}" onerror='this.src="{{$imgerror}}"' class="rounded-circle" height="50" width="50" alt="Avatar">
        <i class="fa-solid fa-caret-down text-type1" style="position: relative;left: -15px;bottom: -20px;"></i>
    </button>
    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark rounded-0 p-0">
        <li>
            <a class="dropdown-item py-3" href="#">Perfil</a>
        </li>
        <li>
            <form action="/logout" method="get" style="display: inline;">
                @csrf
                <a class="dropdown-item py-3" href="#" onclick="this.closest('form').submit()">Logout</a>
            </form>
        </li>
    </ul>
</div>

