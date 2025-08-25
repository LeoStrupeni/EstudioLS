<div class="modal fade" id="edittypesdocmov" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true" >
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Tipo de movimiento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-none" id="modal-body-edit-typesdocmov-error">
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
            <div class="modal-body" id="modal-body-edit-typesdocmov-roller">
                <div style="display:block;" class="text-center">
                    <br>
                    <br>
                    <div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
                    <br>
                    <br>
                    <br>
                </div>
            </div>
            <div class="modal-body d-none" id="modal-body-edit-typesdocmov">
                <form action="" method="POST" id="formedittypesdocmov">
                    @csrf
                    @method('PUT')
                    <div class="mb-2">
                        <label for="name" class="form-label mb-0 ps-3">Nombre</label>
                        <input type="text" class="form-control validate" name="name" id="e_name" placeholder="" required value="{{ old('name') }}">
                    </div>
                    <div class="mb-2">
                        <label for="description" class="form-label mb-0 ps-3">Descripcion</label>
                        <input type="text" class="form-control" name="description" id="e_description" required value="{{ old('description') }}">
                    </div>
                    <div class="mb-2">
                        <label for="type" class="form-label mb-0 ps-3">Tipo</label>
                        <select class="form-control validate" name="type" id="e_type" style="width: 100%" required>
                            <option></option>
                            <option value="I">Ingreso</option>
                            <option value="E">Egreso</option>
                            <option value="IE">Ingreso y Egreso</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer d-none" id="modal-footer-edit-typesdocmov">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-success" id="btn-update-typesdocmov">Actualizar</button>
            </div>
        </div>
    </div>
</div>