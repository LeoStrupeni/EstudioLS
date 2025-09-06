<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('Layout/head')
    {{-- in head includes yield('link_by_page') --}}
    @yield('style_by_page')
<body>
    @include('Layout/aside')

    <div class="container-fluid p-0 @if($_SERVER['REQUEST_URI'] == '/login') h-100 @endif" id="inicio">
        @include('Layout/header')
        @yield('Content')    
    </div>
    <div class="container-fluid p-0 @if($_SERVER['REQUEST_URI'] == '/login') d-none @endif">
        <footer class="fixed-bottom">
            <div class="bg-type3 d-flex flex-column flex-sm-row justify-content-between p-2 px-5 mt-2 border-top">
                <p class="m-0 pt-1">© 2025 Desarrolo Strupeni Leonardo, Todos los derechos reservados.</p>
                <ul class="list-unstyled d-flex m-0">
                    <li class="ms-3">
                        <a class="link-body-emphasis" href="https://www.instagram.com/estudiojuridico.ls/" aria-label="Instagram" target="_blank">
                            <i class="fa-brands fa-2x fa-instagram"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </footer>
    </div>
    

    @include('Layout/script')
    
    @yield('script_by_page')
</body>
</html>