<div class="modal fade" id="createbalances" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nuevo Saldo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" id="formnewbalances">
                    @csrf
                    <div class="mb-2">
                        <label for="type" class="form-label mb-0 ps-3 fw-bold">Tipo</label>
                        <select class="form-select validate" name="type" id="type" style="width: 100%" required onchange="validateinputsform(document.getElementById('formnewbalances'));">
                            <option value="saldo" selected>Saldo</option>
                            <option value="cotizacion">Cotizacion</option>
                        </select>
                    </div>

                    <div class="mb-2">
                        <label for="type_money" class="form-label mb-0 ps-3 fw-bold">Moneda</label>
                        <select class="form-select validate" name="type_money" id="type_money" style="width: 100%" required onchange="validateinputsform(document.getElementById('formnewbalances'));">
                            <option value="dolar"selected>Dolar</option>
                            <option value="peso">Peso</option>
                            <option value="jus">JUS</option>
                        </select>
                    </div>

                    <div class="mb-2">
                        <label for="fecha" class="form-label mb-0 ps-3 fw-bold">Fecha</label>
                        <input type="text" class="form-control validate" name="fecha" id="fechaC" required value="{{ old('fecha') }}" onchange="validateinputsform(document.getElementById('formnewbalances'));">
                    </div>

                    <div class="mb-2">
                        <label for="price" class="form-label mb-0 ps-3 fw-bold">Monto</label>
                        <input type="number" class="form-control validate" name="price" required value="{{ old('price') }}" onchange="validateinputsform(document.getElementById('formnewbalances'));">  
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-type1" id="btn-create-balances">Guardar</button>
            </div>
        </div>
    </div>
</div>