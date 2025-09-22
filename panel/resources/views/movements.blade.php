@php
    $varcoltable='col-11';$varcolalerts='d-none';
    if (Session::get('user')['roles'][0] == 'admin' || Session::get('user')['roles'][0] == 'sistema')
    {
        $varcoltable='col-12 col-xl-10 order-1 order-xl-0';
        $varcolalerts='col-12 col-xl-2 order-0 order-xl-1';
    }
@endphp
<div class="container-fluid">    
    <div class="row justify-content-center mt-3 px-2">

        <div class="{{$varcoltable}} bg-white rounded p-2">
            <div class="row align-items-center justify-content-between">
                <div class="col pe-0">
                    <h5 class="navbar-brand ps-2">Cuenta General</h5>
                </div>
                <div class="col ps-0">
                    <button type="button" class="btn btn-type1 float-end" onclick="callregister('/movement/table',1,$('#table_limit').val(),$('#table_order').val(),'si')"><i class="fa-solid fa-arrows-rotate"></i></button>
                    @if (in_array('create',Session::get('user')['permissions']['moves']))
                        <button type="button" class="btn btn-type1 float-end mx-1 create"><i class="fa-solid fa-plus"></i></button>
                    @endif

                    <button class="btn btn-type1 float-end" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasFiltersMovs" aria-controls="offcanvasFiltersMovs">
                        <i class="fa-solid fa-filter"></i>
                    </button>
                    
                    <button type="button" class="btn btn-type1 float-end fastcharge mx-1 d-none d-md-block">Carga rápida</button>
                </div>
            </div>
            
            <hr class="m-1" style="color: black;">

            @include('Layout.errors')

            <div class="row my-3 align-items-center justify-content-between">
                <div class="col-12" id="filtrosaplicados">
                    
                </div>
                <div class="col-5 col-md-3 col-lg-2">
                    <select class="form-select form-select-sm" id="table_limit">
                        <option value="5">5</option>
                        <option value="10" selected>10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
                <div class="col-7 col-lg-6">
                    <div class="w-100 float-end" style="position: relative;padding: 0;">
                        <input type="text" class="form-control form-control-sm" placeholder="¿Qué buscas?" id="table_search">
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
                </table>
                @include('Layout.tables.roller')
            </div>
            @include('Layout.tables.small')
            @include('Layout.tables.info')
        </div>
        
        <div class="{{$varcolalerts}}">
            <div class="accordion d-block d-lg-none mb-3" id="accordionSaldos">
                <div class="accordion-item bg-transparent border-0">
                    <h2 class="accordion-header">
                        <button class="accordion-button bg-type3 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseS" aria-expanded="false" aria-controls="collapseS">
                            Saldos
                        </button>
                    </h2>
                    <div id="collapseS" class="accordion-collapse collapse" data-bs-parent="#accordionSaldos">
                        <div class="accordion-body px-2">
                            <div class="row">
                                @include('movement.balances')
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row d-none d-lg-flex">
                <div class="col pe-0 mb-2">
                    <div class="accordion" id="accordionSaldos2">
                        <div class="accordion-item bg-transparent border-0">
                            <div class="d-grid gap-2">
                                <button class="btn btn-sm bg-type3 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseS2" aria-expanded="false" aria-controls="collapseS2" id="btnToggleSaldos2">
                                    <i class="fa-solid fa-2x fa-eye"></i>&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-2x fa-scale-balanced"></i>
                                    {{-- <i class="fa-solid fa-eye-slash"></i> --}}
                                </button>
                            </div>                            
                            <div id="collapseS2" class="accordion-collapse collapse" data-bs-parent="#accordionSaldos2">
                                <div class="accordion-body px-2">
                                    <div class="row">
                                        @include('movement.balances')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>

    </div>
</div>
