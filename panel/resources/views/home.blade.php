@extends('layout')

@auth
  @section('link_by_page')
  @endsection
  @section('style_by_page')
  @endsection

  @section('Content')
    @include('movements')

    @include('movement.create')
    @include('movement.edit')
    @include('movement.show')
    @include('destroyforms')
    @include('movement.offcanvasfilters')
    @include('budget.show')
  @endsection

  @section('script_by_page')
    <script src="{{env('APP_URL')}}/assets/plugins/ckeditor_4.22.1_standard/ckeditor/ckeditor.js"></script>
    <script src="{{env('APP_URL')}}/assets/js/local/movement.js"></script>
  @endsection

  
@else
  @include('home.public.style')
  @include('home.public.content')
  @include('home.public.script')
@endauth