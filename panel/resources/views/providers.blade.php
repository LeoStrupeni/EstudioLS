@extends('layout')

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
                        <h5 class="navbar-brand ps-2">Proveedores</h5>
                    </div>
                    <div class="col">
                        <button type="button" class="btn btn-type1 float-end ms-1" onclick="callregister('/provider/table',1,$('#table_limit').val(),$('#table_order').val(),'si')"><i class="fa-solid fa-arrows-rotate"></i></button>
                        @if (in_array('create',Session::get('user')['permissions']['providers']))
                            <button type="button" class="btn btn-type1 float-end create"><i class="fa-solid fa-plus"></i></button>
                        @endif
                    </div>
                </div>
                
                <hr class="m-1" style="color: black;">

                @include('Layout.errors')
                @include('Layout.tables.filters')
                <div class="table-responsive">
                    <table class="table table-sm table-hover table-bordered text-center sortable" id="table">
                        <thead class="table-type1">
                            <tr>
                                <th class="column_orden" data-name="first_name">Nombre</th>
                                <th class="column_orden" data-name="num_doc">Documento</th>
                                <th class="column_orden" data-name="email">Email</th>
                                <th class="column_orden" data-name="phone1">Teléfono</th>
                                <th class="column_orden" data-name="state">Provincia</th>
                                <th class="column_orden" data-name="city">Ciudad</th>
                                <th class="sorttable_nosort" style="width:3%;"></th>
                            </tr>
                        </thead>
                        <tbody id="table_body" class="table-group-divider">

                        </tbody>
                    </table>
                    @include('Layout.tables.roller')
                </div>
                @include('Layout.tables.small')
                @include('Layout.tables.info')
            </div>
        </div>
    </div>
    
    {{-- @include('home.foot') --}}
    @include('provider.create')
    @include('provider.edit')
    @include('provider.show')
    @include('destroyforms')
@endsection

@section('script_by_page')
    <script src="{{env('APP_URL')}}/assets/js/local/provider.js"></script>
@endsection



