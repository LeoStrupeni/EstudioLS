<div class="modal fade" id="createtypesdocmov" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true" >
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nuevo Tipo de movimiento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" id="formnewtypesdocmov">
                    @csrf
                    <div class="mb-2">
                        <label for="name" class="form-label mb-0 ps-3">Nombre</label>
                        <input type="text" class="form-control validate" name="name" id="name" placeholder="" required value="{{ old('name') }}">
                    </div>
                    <div class="mb-2">
                        <label for="description" class="form-label mb-0 ps-3">Descripcion</label>
                        <input type="text" class="form-control" name="description" id="description" required value="{{ old('description') }}">
                    </div>
                    <div class="mb-2">
                        <label for="type" class="form-label mb-0 ps-3">Tipo</label>
                        <select class="form-control validate" name="type" id="type" style="width: 100%" required>
                            <option></option>
                            <option value="I">Ingreso</option>
                            <option value="E">Egreso</option>
                            <option value="IE">Ingreso y Egreso</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-success" id="btn-create-typesdocmov">Guardar</button>
            </div>
        </div>
    </div>
</div>