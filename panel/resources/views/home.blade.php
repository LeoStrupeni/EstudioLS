@extends('Layout')

@auth

@else 
  @include('home.public.style')
  @include('home.public.content')
  @include('home.public.script')
@endauth