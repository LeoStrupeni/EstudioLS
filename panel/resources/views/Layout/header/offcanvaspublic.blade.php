<button type="button" class="btn btn-link rounded-circle p-0 me-3" data-bs-toggle="offcanvas" href="#offcanvasMenu" >
    <span class="navbar-toggler-icon"></span>
</button>

<div class="offcanvas offcanvas-start" data-bs-scroll="false" tabindex="-1" id="offcanvasMenu" aria-labelledby="offcanvasMenuLabel" style="width: auto!important;">
    <div class="offcanvas-header">
        <img src="{{env('APP_URL')}}/assets/media/originales/logo_lignos_seguro.png" alt="Logo" height="60">
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close" style="background-color: white !important;opacity: 1;"></button>
    </div>
    <div class="offcanvas-body">
      <ul class="list-unstyled ps-0">
        <li class="mb-2">
          <button type="button" class="btn rounded-0 ir w-100" aria-current="page" data-href="inicio" data-bs-dismiss="offcanvas">
            Inicio
          </button>
        </li>
        <li class="mb-2">
          <button type="button" class="btn rounded-0 ir w-100" aria-current="page" data-href="tramites" data-bs-dismiss="offcanvas">
              Trámites
          </button>
        </li>
        <li class="mb-2">
            <button type="button" class="btn rounded-0 ir w-100" aria-current="page" data-href="nosotros" data-bs-dismiss="offcanvas" style="height: auto!important;">
                Nosotros
            </button>
        </li>
        <li class="mb-2">
            <button type="button" class="btn rounded-0 ir w-100" aria-current="page" data-href="novedades" data-bs-dismiss="offcanvas">
                Novedades
            </button>
        </li>
        <li class="mb-2">
            <button type="button" class="btn rounded-0 ir w-100" aria-current="page" data-href="quienessomos" data-bs-dismiss="offcanvas">
                Quienes somos
            </button>
        </li>
        <li class="mb-2">
            <button type="button" class="btn rounded-0 ir w-100" aria-current="page" data-href="contacto" data-bs-dismiss="offcanvas" >
                Contacto
            </button>
        </li>
        <li class="mb-2">
            <button type="button" class="btn rounded-0 ir w-100" aria-current="page" onclick="window.location.href='{{route('login')}}'">
                Intra
            </button>
        </li>
      </ul>
    </div>
</div>