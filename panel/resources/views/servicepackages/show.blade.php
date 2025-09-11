<div class="modal fade" id="showservice_package" tabindex="-1" aria-hidden="true" >
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ver Servicio</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-none" id="modal-body-show-service_package-error">
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
            <div class="modal-body" id="modal-body-show-service_package-roller">
                <div style="display:block;" class="text-center">
                    <br>
                    <br>
                    <div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
                    <br>
                    <br>
                    <br>
                </div>
            </div>
            <div class="modal-body d-none" id="modal-body-show-service_package">
                <form id="formshowservice_package">
                    <div class="mb-2">
                        <label for="name" class="form-label mb-0 ps-3">Nombre</label>
                        <input type="text" class="form-control form-control-sm" name="name" placeholder="" readonly>
                    </div>
                    <div class="mb-2">
                        <label for="observations" class="form-label mb-0 ps-3 fw-bold">Descripcion</label>
                        <input type="text" class="form-control form-control-sm" name="observations" readonly>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-sm table-hover align-middle text-center">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Servicio</th>
                                    <th scope="col">Descripcion</th>
                                    <th scope="col">Moneda</th>
                                    <th scope="col">Precio</th>
                                </tr>
                            </thead>
                            <tbody id="service_packages-table-tbody_show">
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>