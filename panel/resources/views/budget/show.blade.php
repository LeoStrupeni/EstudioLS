<div class="modal fade" id="showbudget" tabindex="-1" aria-hidden="true" >
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" style="min-width: 95%">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ver Presupuesto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-none" id="modal-body-show-budget-error">
                <div style="display:block;" class="text-center">
                    <br>
                    <br>
                    <div class="alert alert-type1 m-0 justify-content-center" role="alert">
                        <h5 class="m-0">Error al obtener la informacion. Por favor reintentelo o comuniquese con Soporte</h5>
                    </div>
                    <br>
                    <br>
                </div>
            </div>
            <div class="modal-body" id="modal-body-show-budget-roller">
                <div style="display:block;" class="text-center">
                    <br>
                    <br>
                    <div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
                    <br>
                    <br>
                    <br>
                </div>
            </div>
            <div class="modal-body d-none" id="modal-body-show-budget">
                <form id="formshowbudget">
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="mb-2">
                                <label for="client_id" class="form-label mb-0 ps-3 fw-bold">
                                    Cliente
                                </label>
                                <input type="text" class="form-control text-center" id="client_show" readonly>
                            </div>
                        </div>
                        <div class="col-4 col-lg-2">
                            <div class="mb-2">
                                <label for="fecha" class="form-label mb-0 ps-3 fw-bold text-center">Fecha</label>
                                <input type="text" class="form-control text-center"  id="fecha_show" readonly>
                            </div>
                        </div>
                        <div class="col-4 col-lg-2">
                            <div class="mb-2">
                                <label for="valid" class="form-label mb-0 ps-3 fw-bold text-center">Validez</label>
                                <input type="number" class="form-control text-center"  id="valid_show" readonly>
                            </div>
                        </div>
                        <div class="col-4 col-lg-2">
                            <div class="mb-2">
                                <label for="valid" class="form-label mb-0 ps-3 fw-bold text-center">Estado</label>
                                <input type="text" class="form-control text-center"  id="estatus_show" readonly>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="mb-2">
                                <label for="observations" class="form-label mb-0 ps-3 fw-bold">Observaciones</label>
                                <textarea class="form-control" id="observations_show" rows="2"></textarea>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="mb-2">
                                <label for="payment_methods" class="form-label mb-0 ps-3 fw-bold">Formas de pago</label>
                                <textarea class="form-control" id="payment_methods_show" rows="1"></textarea>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="mb-2">
                                <label for="includes" class="form-label mb-0 ps-3 fw-bold">Incluye</label>
                                <textarea class="form-control" id="includes_show" rows="2"></textarea>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="mb-2">
                                <label for="not_includes" class="form-label mb-0 ps-3 fw-bold">No incluye</label>
                                <textarea class="form-control" id="not_includes_show" rows="3"></textarea>
                            </div>
                        </div>
                        
                        <div class="col-12" >
                            <div class="mb-2">
                                <label for="clarifications" class="form-label mb-0 ps-3 fw-bold">Aclaraciones</label>
                                <textarea class="form-control" id="clarifications_show" rows="5"></textarea>
                            </div>
                        </div>
                        
                        <div class="col m-3">
                            <div class="table-responsive">
                                <table class="table table-sm table-hover align-middle text-center">
                                    <thead class="table-dark">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Servicio</th>
                                            <th scope="col">Descripcion</th>
                                            <th scope="col">Moneda</th>
                                            <th scope="col">Precio</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table_show">
                                    </tbody>
                                </table>
                            </div>
                        </div>                        
                    </div>
                    <div class="row ">
                        <div class="col-12 mt-5">
                            <div class="row col-12 col-md-4 offset-md-8 mb-2">
                                <label class="col-4 col-form-label text-end text-nowrap">Sub-Total</label>
                                <div class="col-8">
                                    <div class="input-group">
                                        <span class="input-group-text" style="width: 56px!important;justify-content: center">$</span>
                                        <input type="text" id="subtotal_show_p" class="form-control text-end" readonly style="background-color: #f7f8fa;border-color: rgb(226, 229, 236);">
                                    </div>
                                </div>
                            </div>
                            <div class="row col-12 col-md-8 offset-md-4 mb-2">
                                <label class="col-4 col-md-2 order-3 order-md-1 col-form-label text-end text-nowrap">Cotizacion</label>
                                <div class="col-8 col-md-4 order-4 order-md-2 ">
                                    <div class="input-group">
                                        <span class="input-group-text" style="width: 56px!important;justify-content: center">U$S</span>
                                        <input type="text" id="cotizacion_show_u" class="form-control text-end"  readonly style="background-color: #f7f8fa;border-color: rgb(226, 229, 236);">
                                    </div>
                                </div>

                                <label class="col-4 col-md-2 order-1 order-md-3 col-form-label text-end text-nowrap">Sub-Total</label>
                                <div class="col-8 col-md-4 order-2 order-md-4">
                                    <div class="input-group">
                                        <span class="input-group-text" style="width: 56px!important;justify-content: center">U$S</span>
                                        <input type="text" id="subtotal_show_u" class="form-control text-end" readonly style="background-color: #f7f8fa;border-color: rgb(226, 229, 236);">
                                    </div>
                                </div>
                            </div>

                            <div class="row col-12 col-md-8 offset-md-4 mb-2">
                                <label class="col-4 col-md-2 order-3 order-md-1 col-form-label text-end text-nowrap">Cotizacion</label>
                                <div class="col-8 col-md-4 order-4 order-md-2 ">
                                    <div class="input-group">
                                        <span class="input-group-text" style="width: 56px!important;justify-content: center">JUS</span>
                                        <input type="text" id="cotizacion_show_j" class="form-control text-end"  readonly style="background-color: #f7f8fa;border-color: rgb(226, 229, 236);">
                                    </div>
                                </div>

                                <label class="col-4 col-md-2 order-1 order-md-3 col-form-label text-end text-nowrap">Sub-Total</label>
                                <div class="col-8 col-md-4 order-2 order-md-4">
                                    <div class="input-group">
                                        <div class="input-group">
                                            <span class="input-group-text" style="width: 56px!important;justify-content: center">JUS</span>
                                            <input type="text" id="subtotal_show_j" class="form-control text-end" readonly style="background-color: #f7f8fa;border-color: rgb(226, 229, 236);">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row col-12 col-md-4 offset-md-8 mb-2">
                                <label class="col-4 col-form-label text-end text-nowrap">Total</label>
                                <div class="col-8">
                                    <div class="input-group">
                                        <span class="input-group-text" style="width: 56px!important;justify-content: center">$</span>
                                        <input type="text" id="total_show_p" class="form-control text-end" readonly style="background-color: #f7f8fa;border-color: rgb(226, 229, 236);">
                                    </div>
                                </div>
                            </div>

                            <div class="row col-12 col-md-4 offset-md-8 mb-2">
                                <label class="col-4 col-form-label text-end text-nowrap">Total</label>
                                <div class="col-8">
                                    <div class="input-group">
                                        <span class="input-group-text" style="width: 56px!important;justify-content: center">U$S</span>
                                        <input type="text" id="total_show_u" class="form-control text-end" readonly style="background-color: #f7f8fa;border-color: rgb(226, 229, 236);">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>