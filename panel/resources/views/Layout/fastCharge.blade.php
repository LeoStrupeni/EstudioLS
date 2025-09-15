<div class="modal fade" id="fastcharge" tabindex="-1" aria-labelledby="fastchargeLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content bg-type4">
      <div class="modal-header py-2">
        <h5 class="modal-title">Carga Rápida</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="form_fastcharge">
            <div class="mb-2">
                <label for="type" class="form-label mb-0 ps-3 fw-bold">Tipo</label>
                <select class="form-select" name="type">
                    <option value="client">Cliente</option>
                    <option value="provider">Proveedor</option>
                </select>
            </div>

            <div class="mb-2">
                <label for="first_name" class="form-label mb-0 ps-3 fw-bold">Nombre</label>
                <input type="text" class="form-control validate" name="first_name">
            </div>
            <div class="mb-2">
                <label for="last_names" class="form-label mb-0 ps-3 fw-bold">Apellido</label>
                <input type="text" class="form-control validate" name="last_names">
            </div>
            <div class="mb-2">
                <label for="type_doc" class="form-label mb-0 ps-3 fw-bold">Tipo Doc</label>
                <select class="form-select validate" name="type_doc">
                    <option value="1" selected>Dni</option>
                    <option value="2">Cuil</option>
                    <option value="3">Cuit</option>
                </select>
            </div>
            <div class="mb-2">
                <label for="num_doc" class="form-label mb-0 ps-3 fw-bold">Num Doc</label>
                <input type="text" class="form-control validate" name="num_doc">
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-type1" id="btn_fastcharge">Guardar</button>
      </div>
    </div>
  </div>
</div>