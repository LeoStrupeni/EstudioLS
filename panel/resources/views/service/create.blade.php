<div class="modal fade" id="createservice" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true" >
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nuevo Servicio</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" id="formnewservice">
                    @csrf
                    <div class="mb-2">
                        <label for="name" class="form-label mb-0 ps-3">Nombre</label>
                        <input type="text" class="form-control validate" name="name" id="name" placeholder="" required value="{{ old('name') }}">
                    </div>
                    <div class="mb-2">
                        <label for="observations" class="form-label mb-0 ps-3 fw-bold">Descripcion</label>
                        <input type="text" class="form-control" name="observations" id="observations" value="{{ old('observations') }}">
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-2">
                                <label for="type_money" class="form-label mb-0 ps-3 fw-bold">Moneda</label>
                                <select class="form-select validate" name="type_money" style="width: 100%" required>
                                    <option value="" selected disabled>Seleccione una opcion ...</option>
                                    <option value="peso">Pesos ($)</option>
                                    <option value="dolar" selected>Dolar (U$S)</option>
                                    <option value="jus">JUS</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-2">
                                <label for="price" class="form-label mb-0 ps-3 fw-bold">Precio</label>
                                <input type="number" class="form-control validate" name="price" id="price" placeholder="" value="{{ old('price') }}">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-type1" id="btn-create-service">Guardar</button>
            </div>
        </div>
    </div>
</div>