<div class="modal fade" id="showservice" tabindex="-1" aria-hidden="true" >
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ver Servicio</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-none" id="modal-body-show-service-error">
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
            <div class="modal-body" id="modal-body-show-service-roller">
                <div style="display:block;" class="text-center">
                    <br>
                    <br>
                    <div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
                    <br>
                    <br>
                    <br>
                </div>
            </div>
            <div class="modal-body d-none" id="modal-body-show-service">
                <form id="formshowservice">
                    <div class="mb-2">
                        <label for="name" class="form-label mb-0 ps-3">Nombre</label>
                        <input type="text" class="form-control form-control-sm" name="name" placeholder="" readonly>
                    </div>
                    <div class="mb-2">
                        <label for="observations" class="form-label mb-0 ps-3 fw-bold">Descripcion</label>
                        <input type="text" class="form-control form-control-sm" name="observations" readonly>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-2">
                                <label for="type_money" class="form-label mb-0 ps-3 fw-bold">Moneda</label>
                                <input type="text" class="form-control form-control-sm" name="type_money" placeholder="" readonly>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-2">
                                <label for="price" class="form-label mb-0 ps-3 fw-bold">Precio</label>
                                <input type="number" class="form-control form-control-sm" name="price" placeholder="" readonly>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>