<div class="modal fade" id="showaccount" tabindex="-1" aria-hidden="true" >
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ver Cuenta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-none" id="modal-body-show-account-error">
                <div style="display:block;" class="text-center">
                    <br>
                    <br>
                    <div class="alert alert-info m-0 justify-content-center" role="alert">
                        <h5 class="m-0">Error al obtener la informacion. Por favor reintentelo o comuniquese con Soporte</h5>
                    </div>
                    <br>
                    <br>
                </div>
            </div>
            <div class="modal-body" id="modal-body-show-account-roller">
                <div style="display:block;" class="text-center">
                    <br>
                    <br>
                    <div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
                    <br>
                    <br>
                    <br>
                </div>
            </div>
            <div class="modal-body d-none" id="modal-body-show-account">
                <form id="formshowaccount">
                    <div class="mb-2">
                        <label for="account_holder" class="form-label mb-0 ps-3 fw-bold">Titular</label>
                        <input type="text" class="form-control" name="account_holder" readonly>
                    </div>
                    <div class="mb-2">
                        <label for="name" class="form-label mb-0 ps-3 fw-bold">Nombre</label>
                        <input type="text" class="form-control" name="name" readonly>
                    </div>
                    <div class="mb-2">
                        <label for="bank" class="form-label mb-0 ps-3 fw-bold">Banco</label>
                        <input type="text" class="form-control" name="bank"readonly>
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="mb-2">
                                <label for="type" class="form-label mb-0 ps-3 fw-bold">Tipo cuenta</label>
                                <select class="form-control" name="type" id="type" style="width: 100%" required>
                                    <option value="CA">Caja de ahorro</option>
                                    <option value="CC">Cuenta Corriente</option>
                                    <option value="CR">Cuenta Remunerada</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="mb-2">
                                <label for="type_money" class="form-label mb-0 ps-3 fw-bold">Moneda</label>
                                <select class="form-control" name="type_money" id="type_money" style="width: 100%" required>
                                    <option value="peso">Peso</option>
                                    <option value="dolar">Dolar</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-2">
                        <label for="number" class="form-label mb-0 ps-3 fw-bold">Número de cuenta</label>
                        <input type="text" class="form-control" name="number" readonly>
                    </div>
                    <div class="mb-2">
                        <label for="cbu" class="form-label mb-0 ps-3 fw-bold">CBU / CVU</label>
                        <input type="text" class="form-control" name="cbu" readonly>
                    </div>
                    <div class="mb-2">
                        <label for="alias" class="form-label mb-0 ps-3 fw-bold">Alias</label>
                        <input type="text" class="form-control" name="alias" readonly>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>