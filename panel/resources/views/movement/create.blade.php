<div class="modal fade" id="createmovement" aria-hidden="true" >
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <div class="col-6">
                    <h5 class="modal-title" id="exampleModalLabel">Nuevo Movimiento</h5>
                </div>
                <div class="col-5">
                    <button type="button" class="btn btn-type1 float-end fastcharge">Carga rápida</button>
                </div>
                
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/movement" method="POST" id="formnewmovement">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="mb-2">
                                <label for="type" class="form-label mb-0 ps-3 fw-bold">Tipo Movimiento</label>
                                <select class="form-select form-select-sm validate" name="type" style="width: 100%" required onchange="labelbankaccounts(this.value,this);">
                                    <option value="" selected class="select-empty" style="color: #aaa;">Seleccione una opcion ...</option>
                                    <option value="ingreso">Ingreso</option>
                                    <option value="egreso">Egreso</option>
                                    <option value="cambio">Cambio USD</option>
                                    <option value="caja">Caja</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="mb-2">
                                <label for="type_document" class="form-label mb-0 ps-3 fw-bold">Documento</label>
                                <select class="form-select form-select-sm validate" name="type_document" style="width: 100%" required>
                                    <option value="" selected class="select-empty" style="color: #aaa;">Seleccione una opcion ...</option>
                                    @foreach ($types_doc_movement as $mov)
                                        <option value="{{$mov->id}}" data-type="{{$mov->type}}">{{$mov->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="mb-2">
                                <label for="type_payment" class="form-label mb-0 ps-3 fw-bold">Método</label>
                                <select class="form-select form-select-sm validate" name="type_payment" style="width: 100%" required>
                                    <option value="" selected class="select-empty" style="color: #aaa;">Seleccione una opcion ...</option>
                                    <option value="efectivo">Efectivo</option>
                                    <option value="transferencia">Transferencia</option>
                                    <option value="credito">Crédito</option>
                                    <option value="mercadopago">Mercado Pago</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="mb-2">
                                <label for="type_money" class="form-label mb-0 ps-3 fw-bold">Moneda</label>
                                <select class="form-select form-select-sm validate" name="type_money" style="width: 100%" required onchange="getlistbankaccounts(this);">
                                    <option value="" selected class="select-empty" style="color: #aaa;">Seleccione una opcion ...</option>
                                    <option value="peso">Pesos ($)</option>
                                    <option value="dolar">Dolar (U$S)</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="mb-2">
                                <label for="fecha" class="form-label mb-0 ps-3 fw-bold">Fecha</label>
                                <input type="text" class="form-control form-control-sm validate" name="fecha" id="fechaC" required>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="mb-2">
                                <label for="type_origin" class="form-label mb-0 ps-3 fw-bold">Tipo</label>
                                <select class="form-select form-select-sm validate" name="type_origin" id="type_origin_c" style="width: 100%" required>
                                    <option value="" selected class="select-empty" style="color: #aaa;">Seleccione una opcion ...</option>
                                    <option value="client">Cliente</option>
                                    <option value="provider">Proveedor</option>
                                    <option value="user">Usuario</option>
                                    <option value="caja">Caja Chica (Egreso)</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 d-none" id="client_c">
                            <div class="mb-2">
                                <label for="client_id" class="form-label mb-0 ps-3 fw-bold">
                                    Cliente
                                    <span class="d-none spinner-data">
                                        <div class="spinner-border spinner-border-sm text-primary" role="status"></div>
                                    </span>
                                </label>
                                <select class="form-select form-select-sm validate" name="client_id" id="client_id_c" style="width: 100%" required>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 d-none" id="budget_c">
                            <div class="mb-2">
                                <label for="budget_c_id" class="form-label mb-0 ps-3 fw-bold">
                                    Presupuesto Relacionado <small class="fw-light fst-italic"> - (Seleccione un prespuesto o dejelo vacío...)</small>
                                    <span class="d-none spinner-budget">
                                        <div class="spinner-border spinner-border-sm text-primary" role="status"></div>
                                    </span>
                                </label>
                                <select class="form-select form-select-sm" name="budget_id" id="budget_c_id" style="width: 100%">
                                    
                                </select>
                            </div>
                        </div>
                        <div class="col-12 d-none" id="budget_item_c">
                            <div class="mb-2">
                                <label for="budget_item_c_id" class="form-label mb-0 ps-3 fw-bold">
                                    Item de Presupuesto Relacionado <small class="fw-light fst-italic"> - (Seleccione un item o dejelo vacío...)</small>
                                    <span class="d-none spinner-budget-item">
                                        <div class="spinner-border spinner-border-sm text-primary" role="status"></div>
                                    </span>
                                </label>
                                <select class="form-select form-select-sm" name="budget_item_id" id="budget_item_c_id" style="width: 100%">
                                    
                                </select>
                            </div>
                        </div>
                        <div class="col-12 d-none" id="provider_c">
                            <div class="mb-2">
                                <label for="provider_id" class="form-label mb-0 ps-3 fw-bold">
                                    Proveedor
                                    <span class="d-none spinner-data">
                                        <div class="spinner-border spinner-border-sm text-primary" role="status"></div>
                                    </span>
                                </label>
                                <select class="form-select form-select-sm validate" name="provider_id" id="provider_id_c" style="width: 100%" required>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 d-none" id="user_c">
                            <div class="mb-2">
                                <label for="user_id" class="form-label mb-0 ps-3 fw-bold">
                                    Usuario
                                    <span class="d-none spinner-data">
                                        <div class="spinner-border spinner-border-sm text-primary" role="status"></div>
                                    </span>
                                </label>
                                <select class="form-select form-select-sm validate" name="user_id" id="user_id_c" style="width: 100%" required>
                                    
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-2">
                                <label for="concepto" class="form-label mb-0 ps-3 fw-bold">Concepto de Pago</label>
                                <input type="text" class="form-control form-control-sm validate" name="concepto" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-2">
                                <label for="payment_detail" class="form-label mb-0 ps-3 fw-bold">Detalle de pago</label>
                                <textarea class="form-control form-control-sm" name="payment_detail" rows="1"></textarea>
                            </div>
                        </div>
                        
                        <div class="col-12">
                            <div class="mb-2">
                                <label for="description" class="form-label mb-0 ps-3 fw-bold">Observaciones</label>
                                <textarea class="form-control form-control-sm" name="description" rows="1"></textarea>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="mb-2">
                                <label for="money" class="form-label mb-0 ps-3 fw-bold">Monto</label>
                                <input type="number" class="form-control form-control-sm validate" name="money" required placeholder="Ingrese el monto ..." min="0">  
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="mb-2">
                                <label for="bank_account" class="form-label mb-0 ps-3 fw-bold" id="labelcta">Cuenta</label>
                                <select class="form-select form-select-sm validate" name="bank_account" id="bank_account" style="width: 100%" required>
                                    <option value="" selected class="select-empty" style="color: #aaa;">Seleccione una opcion ...</option>
                                    @foreach ($bank_accounts as $a)
                                        <option data-type="{{$a->type_money}}" value="{{$a->id}}">{{$a->name.' ('.$a->bank.') '.($a->type_money == 'peso' ? '($)' : '(U$S)')}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 d-none">
                            <div class="mb-2">
                                <label for="priceusd" class="form-label mb-0 ps-3 fw-bold">Cotización USD</label>
                                <input type="number" class="form-control form-control-sm" name="priceusd" required placeholder="Ingrese la cotizacion ..." min="0" 
                                    value="{{$price_usd > 0 ? $price_usd : ($price_usd_b > 0 ? $price_usd_b: ($price_usd_o > 0 ? $price_usd_o: 0))}}">  
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 d-none">
                            <div class="mb-2">
                                <label for="bank_account_dest" class="form-label mb-0 ps-3 fw-bold">Cuenta destino</label>
                                <select class="form-select form-select-sm" name="bank_account_dest" style="width: 100%" required>
                                    <option value="" selected class="select-empty" style="color: #aaa;">Seleccione una opcion ...</option>
                                    @foreach ($bank_accounts as $a)
                                        @if ($a->type_money == 'peso')
                                            <option data-type="{{$a->type_money}}" value="{{$a->id}}">{{$a->name.' ('.$a->bank.') '.($a->type_money == 'peso' ? '($)' : '(U$S)')}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="text-center mt-3">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-type1" id="btn-create-movement">Guardar</button>
                </div>
            </div>
            
        </div>
    </div>
</div>