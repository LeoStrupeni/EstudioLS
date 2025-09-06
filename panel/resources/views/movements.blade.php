@php
    $varcoltable='col-11';$varcolalerts='d-none';
    if (Session::get('user')['roles'][0] == 'admin' || Session::get('user')['roles'][0] == 'sistema')
    {
        $varcoltable='col-12 col-xl-10 order-1 order-xl-0';$varcolalerts='col-12 col-xl-2 order-0 order-xl-1';
    }
@endphp
<div class="container-fluid">    
    <div class="row justify-content-center mt-3 px-2">
        <div class="{{$varcoltable}} bg-white rounded p-2">
            <div class="row align-items-center justify-content-between">
                <div class="col">
                    <div class="navbar-brand ps-3 fs-5">Cuenta General</div>
                </div>
                <div class="col">
                    <button type="button" class="btn btn-type1 float-end mx-1" onclick="callregister('/movement/table',1,$('#table_limit').val(),$('#table_order').val(),'si')"><i class="fa-solid fa-arrows-rotate"></i></button>
                    @if (in_array('create',Session::get('user')['permissions']['moves']))
                        <button type="button" class="btn btn-type1 float-end mx-1 create"><i class="fa-solid fa-plus"></i></button>
                    @endif

                    <button class="btn btn-type1 float-end mx-1" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasFiltersMovs" aria-controls="offcanvasFiltersMovs">
                        <i class="fa-solid fa-filter"></i>
                    </button>                    
                </div>
            </div>
            
            <hr class="m-1" style="color: black;">

            @include('Layout.errors')

            <div class="row my-3 align-items-center justify-content-between">
                <div class="col-12" id="filtrosaplicados">

                </div>
                <div class="col-3 col-lg-2">
                    <select class="form-select" id="table_limit">
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
                <div class="col-7 col-lg-6">
                    <div class="w-100 float-end" style="position: relative;padding: 0;">
                        <input type="text" class="form-control" placeholder="¿Qué buscas?" id="table_search">
                        <span style="position: absolute; height: 100%; display: -webkit-box; display: -ms-flexbox; display: flex; -webkit-box-pack: center;-ms-flex-pack: center;justify-content: center;top: 7px;width: 3.2rem;right: 0;">
                            <span><i class="flaticon2-search-1"></i></span>
                        </span>
                    </div>
                </div>
            </div>
            
            <div class="table-responsive">
                <table class="table table-sm table-hover table-bordered text-center sortable" id="table">
                    <thead class="table-type1">
                        <tr>
                            <th class="column_orden text-nowrap fw-medium p-2" data-name="fecha">Fecha</th>
                            <th class="column_orden text-nowrap fw-medium p-2" data-name="type">Tipo</th>
                            <th class="column_orden text-nowrap fw-medium p-2" data-name="cliente">Cliente/Proveedor/Usuario</th>
                            <th class="column_orden text-nowrap fw-medium p-2" data-name="budget_name"># Pres.</th>
                            <th class="column_orden text-nowrap fw-medium p-2" data-name="type_document">Documento</th>
                            <th class="column_orden text-nowrap fw-medium p-2" data-name="type_payment">Tipo Pago</th>
                            <th class="column_orden text-nowrap fw-medium p-2" data-name="payment_detail">Detalle</th>
                            <th class="column_orden text-nowrap fw-medium p-2" data-name="concepto">Concepto</th>
                            <th class="column_orden text-nowrap fw-medium p-2" data-name="type_money">Moneda</th>
                            <th class="column_orden text-nowrap fw-medium p-2" data-name="deposit">Ingreso</th>
                            <th class="column_orden text-nowrap fw-medium p-2" data-name="expense">Egreso</th>
                            <th class="sorttable_nosort" style="width:3%;"></th>
                        </tr>
                    </thead>
                    <tbody id="table_body" class="table-group-divider">

                    </tbody>
                    <tbody id="table_roller" class="table-group-divider">
                        <tr>
                            <td colspan="12">
                                <div style="display:block;" class="text-center">
                                    <br>
                                    <br>
                                    <div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
                                    <br>
                                    <br>
                                    <br>
                                </div>
                            </td>
                        </tr>
                    </tbody>

                    <tbody id="table_error" class="d-none table-group-divider">
                        <tr>
                            <td colspan="12">
                                <div style="display:block;" class="text-center">
                                    <br>
                                    <br>
                                    <div class="alert alert-type1 m-0 justify-content-center" role="alert">
                                        <h5 class="m-0">Error al obtener la informacion. Por favor reintentelo o comuniquese con Soporte</h5>
                                    </div>
                                    <br>
                                    <br>
                                </div>
                            </td>
                        </tr>
                    </tbody>

                    <tbody id="table_sindatos" class="d-none table-group-divider">
                        <tr>
                            <td colspan="12">
                                <div style="display:block;" class="text-center">
                                    <br>
                                    <br>
                                    <div class="alert alert-type1 m-0 justify-content-center" role="alert">
                                        <h5 class="m-0">No se encuentra registros con los filtros aplicados</h5>
                                    </div>
                                    <br>
                                    <br>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="row align-items-center">
                <input type="hidden" id="table_order">
                <input type="hidden" id="table_paginas">
                <input type="hidden" id="table_filtrados">
                <input type="hidden" id="table_totales">
                <div class="col-lg-6" id="table_info">

                </div>
                <div class="col-lg-6" id="table_pagination">

                </div>
            </div>
        </div>
        <div class="{{$varcolalerts}}">
            <div class="row">
                <div class="col-3 col-xl-12 pe-0 ">
                    <div class="alert alert-type1 px-1" role="alert">
                        <h5 class="text-center alert-heading">Saldo $</h5>
                        <hr>
                        <table class="table-sm w-100">
                            <tbody> 
                                @foreach ($balances as $balance)
                                    @if ($balance->type_money == 'peso')
                                        <tr>
                                            <td class="ps-3 pe-0"><h5>@if ($balance->type == 'client') Clientes @else Caja @endif</h5></td>
                                            <td><h5 class="pe-3 text-end">{{number_format($balance->balance,2,',','.')}}</h5></td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-3 col-xl-12 pe-0">
                    <div class="alert alert-type1 px-1" role="alert">
                        <h5 class="text-center alert-heading">Saldo U$S</h5>
                        <hr>
                        <table class="table-sm w-100">
                            <tbody> 
                                @foreach ($balances as $balance)
                                    @if ($balance->type_money == 'dolar')
                                        <tr>
                                            <td class="ps-3 pe-0"><h5>@if ($balance->type == 'client') Clientes @else Caja @endif</h5></td>
                                            <td><h5 class="pe-3 text-end">{{number_format($balance->balance,2,',','.')}}</h5></td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-3 col-xl-12 pe-0">
                    <div class="alert alert-type1 px-1" role="alert">
                        <h5 class="text-center alert-heading">Cotización U$S</h5>
                        <hr>
                        <table class="table-sm w-100">
                            <tbody> 
                                <tr>
                                    <td class="ps-3"><b>Sistema</b></td>
                                    <td>{{$price_usd > 0 ? number_format($price_usd,2,',','.') : 'No disp.'}}</td>
                                </tr>
                                <tr>
                                    <td class="ps-3"><b><a href="{{$origin_usd_o}}" target="_blank" class="text-dark">Oficial</a></b></td>
                                    <td>{{$price_usd_o > 0 ? number_format($price_usd_o,2,',','.') : 'No disp.'}}</td>
                                </tr>
                                <tr>
                                    <td class="ps-3"><b><a href="{{$origin_usd_b}}" target="_blank" class="text-dark">Blue</a></b></td>
                                    <td>{{$price_usd_b > 0 ? number_format($price_usd_b,2,',','.') : 'No disp.'}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-3 col-xl-12 pe-0">
                    <div class="alert alert-type1 px-1" role="alert">
                        <h5 class="text-center alert-heading">Valor JUS ($)</h5>
                        <hr>
                        <h3 class="text-center">{{number_format($price_jus,2,',','.')}}</h3>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
