<div class="modal fade" id="editaccount" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true" >
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Cuenta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-none" id="modal-body-edit-account-error">
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
            <div class="modal-body" id="modal-body-edit-account-roller">
                <div style="display:block;" class="text-center">
                    <br>
                    <br>
                    <div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
                    <br>
                    <br>
                    <br>
                </div>
            </div>
            <div class="modal-body d-none" id="modal-body-edit-account">
                <form action="" method="POST" id="formeditaccount">
                    @csrf
                    @method("PUT")
                    <div class="mb-2">
                        <label for="name" class="form-label mb-0 ps-3 fw-bold">Nombre</label>
                        <input type="text" class="form-control validate" name="name" id="name" placeholder="" required value="{{ old('name') }}" onchange="validateinputsform(document.getElementById('formeditaccount'));">
                    </div>
                    <div class="mb-2">
                        <label for="bank" class="form-label mb-0 ps-3 fw-bold">Banco</label>
                        <input type="text" class="form-control validate" name="bank" id="bank" placeholder="" required value="{{ old('bank') }}" onchange="validateinputsform(document.getElementById('formeditaccount'));">
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="mb-2">
                                <label for="type" class="form-label mb-0 ps-3 fw-bold">Tipo cuenta</label>
                                <select class="form-select validate" name="type" id="type" style="width: 100%" required onchange="validateinputsform(document.getElementById('formeditaccount'));">
                                    <option value="CA">Caja de ahorro</option>
                                    <option value="CC">Cuenta Corriente</option>
                                    <option value="CR">Cuenta Remunerada</option>
                                    <option value="EFE">Caja</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="mb-2">
                                <label for="type_money" class="form-label mb-0 ps-3 fw-bold">Moneda</label>
                                <select class="form-select validate" name="type_money" id="type_money" style="width: 100%" required onchange="validateinputsform(document.getElementById('formeditaccount'));">
                                    <option value="peso">Peso</option>
                                    <option value="dolar">Dolar</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-2">
                        <label for="number" class="form-label mb-0 ps-3 fw-bold">Número de cuenta</label>
                        <input type="text" class="form-control validate" name="number" id="number" placeholder="" required value="{{ old('number') }}" onchange="validateinputsform(document.getElementById('formeditaccount'));">
                    </div>
                    <div class="mb-2">
                        <label for="cbu" class="form-label mb-0 ps-3 fw-bold">CBU / CVU</label>
                        <input type="text" class="form-control validate" name="cbu" id="cbu" placeholder="" required value="{{ old('cbu') }}" onchange="validateinputsform(document.getElementById('formeditaccount'));">
                    </div>
                    <div class="mb-2">
                        <label for="alias" class="form-label mb-0 ps-3 fw-bold">Alias</label>
                        <input type="text" class="form-control validate" name="alias" id="alias" placeholder="" required value="{{ old('alias') }}" onchange="validateinputsform(document.getElementById('formeditaccount'));">
                    </div>
                </form>
            </div>
            <div class="modal-footer d-none" id="modal-footer-edit-account">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-type1" id="btn-update-account">Actualizar</button>
            </div>
        </div>
    </div>
</div>