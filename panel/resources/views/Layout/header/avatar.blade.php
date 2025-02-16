<div class="dropdown">
    <button type="button" class="btn border-0 rounded-circle p-0" data-bs-toggle="dropdown" aria-expanded="true">
        <img src="{{env('APP_URL')}}/assets/media/avatar.jpg" class="rounded-circle" height="48">
        <i class="fa-solid fa-caret-down text-black" style="position: relative;left: -15px;bottom: -20px;"></i>
    </button>
    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark rounded-0 p-0">
        <li>
            <a class="dropdown-item py-3" href="#">Perfil</a>
        </li>
        <li>
            <form action="/logout" method="post" style="display: inline;">
                @csrf
                <a class="dropdown-item py-3" href="#" onclick="this.closest('form').submit()">Logout</a>
            </form>
        </li>
    </ul>
</div>