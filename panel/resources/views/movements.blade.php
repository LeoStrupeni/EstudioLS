
<div class="container-fluid">
    @if (Session::get('user')['roles'][0] == 'admin' || Session::get('user')['roles'][0] == 'sistema' )
        <div class="row justify-content-center mt-4">
            <div class="col-4">
                <div class="alert alert-success" role="alert">
                    <h5 class="text-center alert-heading">Saldo $</h5>
                    <hr>
                    <h3 class="text-center">$ 0.00</h3>
                </div>
            </div>
            <div class="col-4">
                <div class="alert alert-success" role="alert">
                    <h5 class="text-center alert-heading">Saldo U$S</h5>
                    <hr>
                    <h3 class="text-center">U$S 0.00</h3>
                </div>
            </div>
        </div>
    @endif
    
    <div class="row justify-content-center">
        <div class="col-11 bg-white rounded p-2">
            <div class="row align-items-center  justify-content-between">
                <div class="col">
                    <div class="navbar-brand ps-3 fs-5">Cuenta General</div>
                </div>
                <div class="col">
                    <button type="button" class="btn btn-danger float-end mx-1" onclick="callregister('/movement/table',1,$('#table_limit').val(),$('#table_order').val(),'si')"><i class="fa-solid fa-arrows-rotate"></i></button>
                    @if (in_array('create',Session::get('user')['permissions']['moves']))
                        <button type="button" class="btn btn-success float-end mx-1 create"><i class="fa-solid fa-plus"></i></button>
                    @endif

                    <button class="btn btn-primary float-end mx-1" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasFiltersMovs" aria-controls="offcanvasFiltersMovs">
                        <i class="fa-solid fa-filter"></i>
                    </button>                    
                </div>
            </div>
            
            <hr class="m-1" style="color: red;">

            @include('Layout.errors')

            <div class="row my-3 align-items-center justify-content-between">
                <div class="col-12" id="filtrosaplicados">

                </div>
                <div class="col-3 col-xl-1">
                    <select class="form-select" id="table_limit">
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
                <div class="col-7 col-lg-4">
                    <div class="w-100 float-end" style="position: relative;padding: 0;">
                        <input type="text" class="form-control" placeholder="¿Qué buscas?" id="table_search">
                        <span style="position: absolute; height: 100%; display: -webkit-box; display: -ms-flexbox; display: flex; -webkit-box-pack: center;-ms-flex-pack: center;justify-content: center;top: 7px;width: 3.2rem;right: 0;">
                            <span><i class="flaticon2-search-1"></i></span>
                        </span>
                    </div>
                </div>
            </div>
            
            <div class="table-responsive">
                <table class="table table-sm table-hover text-center sortable" id="table">
                    <thead>
                        <tr>
                            <th class="column_orden" data-name="fecha">Fecha</th>
                            <th class="column_orden" data-name="type">Tipo</th>
                            <th class="column_orden" data-name="cliente">Cliente/Proveedor/Usuario</th>
                            <th class="column_orden" data-name="type_document">Documento</th>
                            <th class="column_orden" data-name="type_payment">Tipo Pago</th>
                            <th class="column_orden" data-name="concepto">Concepto</th>
                            <th class="column_orden" data-name="type_money">Moneda</th>
                            <th class="column_orden" data-name="deposit">Ingreso</th>
                            <th class="column_orden" data-name="expense">Egreso</th>
                            <th class="sorttable_nosort" style="width:3%;"></th>
                        </tr>
                    </thead>
                    <tbody id="table_body">

                    </tbody>
                    <tbody id="table_roller">
                        <tr>
                            <td colspan="10">
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

                    <tbody id="table_error" class="d-none">
                        <tr>
                            <td colspan="10">
                                <div style="display:block;" class="text-center">
                                    <br>
                                    <br>
                                    <div class="alert alert-info m-0 justify-content-center" role="alert">
                                        <h5 class="m-0">Error al obtener la informacion. Por favor reintentelo o comuniquese con Soporte</h5>
                                    </div>
                                    <br>
                                    <br>
                                </div>
                            </td>
                        </tr>
                    </tbody>

                    <tbody id="table_sindatos" class="d-none">
                        <tr>
                            <td colspan="10">
                                <div style="display:block;" class="text-center">
                                    <br>
                                    <br>
                                    <div class="alert alert-warning m-0 justify-content-center" role="alert">
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
    </div>
</div>
