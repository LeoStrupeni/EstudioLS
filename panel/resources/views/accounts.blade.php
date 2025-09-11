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
                        <h5 class="navbar-brand ps-2">Cuentas Bancarias</h5>
                    </div>
                    <div class="col">
                        <button type="button" class="btn btn-type1 float-end mx-1" onclick="callregister('/account/table',1,$('#table_limit').val(),$('#table_order').val(),'si')"><i class="fa-solid fa-arrows-rotate"></i></button>
                        @if (in_array('create',Session::get('user')['permissions']['bank_Accounts']))
                            <button type="button" class="btn btn-type1 float-end mx-1 create"><i class="fa-solid fa-plus"></i></button>
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
                                <th class="column_orden" data-name="account_holder">Titular</th>
                                <th class="column_orden" data-name="name">Nombre</th>
                                <th class="column_orden" data-name="bank">Banco</th>
                                <th class="column_orden" data-name="type">Tipo</th>
                                <th class="column_orden" data-name="type_money">Moneda</th>
                                <th class="column_orden" data-name="number">Numero Cta.</th>
                                <th class="column_orden" data-name="cbu">CBU/CVU</th>
                                <th class="column_orden" data-name="alias">Alias</th>
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
    @include('account.create')
    @include('account.edit')
    @include('account.show')
    @include('destroyforms')
@endsection

@section('script_by_page')
    <script src="{{env('APP_URL')}}/assets/js/local/account.js"></script>
@endsection



