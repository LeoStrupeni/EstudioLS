<div class="modal fade" id="createmovement" aria-hidden="true" >
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nuevo Movimiento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/movement" method="POST" id="formnewmovement">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="mb-2">
                                <label for="type" class="form-label mb-0 ps-3 fw-bold">Tipo Movimiento</label>
                                <select class="form-control validate" name="type" style="width: 100%" required onchange="labelbankaccounts(this.value);">
                                    <option></option>
                                    <option value="ingreso">Ingreso</option>
                                    <option value="egreso">Egreso</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="mb-2">
                                <label for="type_document" class="form-label mb-0 ps-3 fw-bold">Documento</label>
                                <select class="form-control validate" name="type_document" style="width: 100%" required>
                                    <option></option>
                                    @foreach ($types_doc_movement as $mov)
                                        <option value="{{$mov->id}}" data-type="{{$mov->type}}">{{$mov->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="mb-2">
                                <label for="type_payment" class="form-label mb-0 ps-3 fw-bold">Método</label>
                                <select class="form-control validate" name="type_payment" style="width: 100%" required>
                                    <option></option>
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
                                <select class="form-control validate" name="type_money" style="width: 100%" required onchange="getlistbankaccounts(this.value);">
                                    <option></option>
                                    <option value="peso">Pesos ($)</option>
                                    <option value="dolar">Dolar (U$S)</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="mb-2">
                                <label for="fecha" class="form-label mb-0 ps-3 fw-bold">Fecha</label>
                                <input type="text" class="form-control validate" name="fecha" id="fechaC" required>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="mb-2">
                                <label for="type_origin" class="form-label mb-0 ps-3 fw-bold">Tipo Cliente</label>
                                <select class="form-control validate" name="type_origin" id="type_origin_c" style="width: 100%" required>
                                    <option></option>
                                    <option value="client">Cliente</option>
                                    <option value="provider">Proveedor</option>
                                    <option value="user">Usuario</option>
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
                                <select class="form-control validate" name="client_id" id="client_id_c" style="width: 100%" required>
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
                                <select class="form-control validate" name="provider_id" id="provider_id_c" style="width: 100%" required>
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
                                <select class="form-control validate" name="user_id" id="user_id_c" style="width: 100%" required>
                                    
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-2">
                                <label for="payment_detail" class="form-label mb-0 ps-3 fw-bold">Detalle de pago</label>
                                <textarea class="form-control" name="payment_detail" rows="1"></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-2">
                                <label for="concepto" class="form-label mb-0 ps-3 fw-bold">Concepto de Pago</label>
                                <input type="text" class="form-control validate" name="concepto" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-2">
                                <label for="description" class="form-label mb-0 ps-3 fw-bold">Observaciones</label>
                                <textarea class="form-control" name="description" rows="1"></textarea>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-2">
                                <label for="money" class="form-label mb-0 ps-3 fw-bold">Monto</label>
                                <input type="number" class="form-control validate" name="money" required>  
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-2">
                                <label for="bank_account" class="form-label mb-0 ps-3 fw-bold" id="labelcta">Cuenta</label>
                                <select class="form-control validate" name="bank_account" id="bank_account" style="width: 100%" required>
                                    <option></option>
                                    @foreach ($bank_accounts as $a)
                                        <option data-type="{{$a->type_money}}" value="{{$a->id}}">{{$a->name.' ('.$a->bank.') '.($a->type_money == 'peso' ? '($)' : '(U$S)')}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-type1" id="btn-create-movement">Guardar</button>
            </div>
        </div>
    </div>
</div>