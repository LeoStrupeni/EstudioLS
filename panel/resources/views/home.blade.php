@extends('Layout')

@auth
  @section('link_by_page')
    <link href="{{env('APP_URL')}}/assets/css/avatar.css" rel="stylesheet" type="text/css" />
  @endsection
  @section('style_by_page')
    <style>
        .my-dropdown-toggle::after {
            content: none;
        }

        .active>.page-link, .page-link.active {
            background-color: var(--bs-green)!important;
            border-color: var(--bs-white)!important;
        }

        .page-link {
            background-color: var(--bs-teal)!important;
            border: var(--bs-pagination-border-width) solid var(--bs-white)!important;
            color: var(--bs-white)!important;
        }

    </style>
  @endsection

  @section('Content')
    @include('movements')

    @include('movement.create')
    @include('movement.edit')
    @include('movement.show')
    @include('movement.destroy')
    @include('movement.offcanvasfilters')

  @endsection

  @section('script_by_page')
      <script src="{{env('APP_URL')}}/assets/js/local/movement.js"></script>
  @endsection

  
@else
  @include('home.public.style')
  @include('home.public.content')
  @include('home.public.script')
@endauth