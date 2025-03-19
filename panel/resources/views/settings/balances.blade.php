@extends('Layout')

@section('link_by_page')

@endsection
@section('style_by_page')

@endsection

@section('Content')
    <div class="container-fluid">
        <div class="row justify-content-center my-4">
            <div class="col-12 col-lg-10 bg-white rounded p-2">
                <div class="row align-items-center  justify-content-between">
                    <div class="col">
                        <div class="navbar-brand ps-3 fs-5">Saldos Iniciales</div>
                    </div>
                    <div class="col">
                        @if (in_array('create',Session::get('user')['permissions']['clients']))
                            <button type="button" class="btn btn-success float-end mx-1 create"><i class="fa-solid fa-plus"></i></button>
                        @endif
                    </div>
                </div>
                
                <hr class="m-1" style="color: red;">

                @include('Layout.errors')

                <div class="row my-3">
                    

                    <div class="col-12 col-md-6">
                        <div class="row">
                            
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="row">
                            
                        </div>
                    </div>

                </div>
               
            </div>
        </div>
    </div>

@endsection

@section('script_by_page')
    {{-- <script src="{{env('APP_URL')}}/assets/js/local/client.js"></script> --}}
@endsection



