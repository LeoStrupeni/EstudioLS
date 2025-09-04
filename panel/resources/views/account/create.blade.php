<div class="modal fade" id="createaccount" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true" >
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nueva Cuenta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" id="formnewaccount">
                    @csrf
                    <div class="mb-2">
                        <label for="account_holder" class="form-label mb-0 ps-3 fw-bold">Titular</label>
                        <input type="text" class="form-control validate" name="account_holder" id="account_holder" placeholder="" required value="{{ old('account_holder') }}" onchange="validateinputsform(document.getElementById('formnewaccount'));">
                    </div>
                    <div class="mb-2">
                        <label for="name" class="form-label mb-0 ps-3 fw-bold">Nombre</label>
                        <input type="text" class="form-control validate" name="name" id="name" placeholder="" required value="{{ old('name') }}" onchange="validateinputsform(document.getElementById('formnewaccount'));">
                    </div>
                    <div class="mb-2">
                        <label for="bank" class="form-label mb-0 ps-3 fw-bold">Banco</label>
                        <input type="text" class="form-control validate" name="bank" id="bank" placeholder="" required value="{{ old('bank') }}" onchange="validateinputsform(document.getElementById('formnewaccount'));">
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="mb-2">
                                <label for="type" class="form-label mb-0 ps-3 fw-bold">Tipo cuenta</label>
                                <select class="form-select validate" name="type" id="type" style="width: 100%" required onchange="validateinputsform(document.getElementById('formnewaccount'));">
                                    <option value="CA" selected>Caja de ahorro</option>
                                    <option value="CC">Cuenta Corriente</option>
                                    <option value="CR">Cuenta Remunerada</option>
                                    <option value="EFE">Caja</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="mb-2">
                                <label for="type_money" class="form-label mb-0 ps-3 fw-bold">Moneda</label>
                                <select class="form-select validate" name="type_money" id="type_money" style="width: 100%" required onchange="validateinputsform(document.getElementById('formnewaccount'));">
                                    <option value="peso" selected>Peso</option>
                                    <option value="dolar">Dolar</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-2">
                        <label for="number" class="form-label mb-0 ps-3 fw-bold">Número de cuenta</label>
                        <input type="text" class="form-control validate" name="number" id="number" placeholder="" required value="{{ old('number') }}" onchange="validateinputsform(document.getElementById('formnewaccount'));">
                    </div>
                    <div class="mb-2">
                        <label for="cbu" class="form-label mb-0 ps-3 fw-bold">CBU / CVU</label>
                        <input type="text" class="form-control validate" name="cbu" id="cbu" placeholder="" required value="{{ old('cbu') }}" onchange="validateinputsform(document.getElementById('formnewaccount'));">
                    </div>
                    <div class="mb-2">
                        <label for="alias" class="form-label mb-0 ps-3 fw-bold">Alias</label>
                        <input type="text" class="form-control validate" name="alias" id="alias" placeholder="" required value="{{ old('alias') }}" onchange="validateinputsform(document.getElementById('formnewaccount'));">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-type1" id="btn-create-account">Guardar</button>
            </div>
        </div>
    </div>
</div>