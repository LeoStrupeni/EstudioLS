<div class="modal fade" id="editbalances" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true" >
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Saldo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-none" id="modal-body-edit-balances-error">
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
            <div class="modal-body" id="modal-body-edit-balances-roller">
                <div style="display:block;" class="text-center">
                    <br>
                    <br>
                    <div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
                    <br>
                    <br>
                    <br>
                </div>
            </div>
            <div class="modal-body d-none" id="modal-body-edit-balances">
                <form action="" method="POST" id="formeditbalances">
                    @csrf
                    @method("PUT")

                    <div class="mb-2">
                        <label for="type" class="form-label mb-0 ps-3 fw-bold">Tipo</label>
                        <input type="text" class="form-control" name="type" readonly>
                    </div>

                    <div class="mb-2">
                        <label for="type_money" class="form-label mb-0 ps-3 fw-bold">Moneda</label>
                        <input type="text" class="form-control" name="type_money" readonly>
                    </div>

                    <div class="mb-2">
                        <label for="fecha" class="form-label mb-0 ps-3 fw-bold">Fecha</label>
                        <input type="text" class="form-control validate" name="fecha" readonly>
                    </div>

                    <div class="mb-2">
                        <label for="price" class="form-label mb-0 ps-3 fw-bold">Monto</label>
                        <input type="number" class="form-control validate" name="price" required value="{{ old('price') }}" onchange="validateinputsform(document.getElementById('formeditbalances'));">  
                    </div>

                </form>
            </div>
            <div class="modal-footer d-none" id="modal-footer-edit-balances">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-type1" id="btn-update-balances">Actualizar</button>
            </div>
        </div>
    </div>
</div>