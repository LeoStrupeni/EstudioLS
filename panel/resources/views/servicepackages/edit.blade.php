<div class="modal fade" id="editservice_package" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true" >
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" style="min-width: 95%!important;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Paquete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-none" id="modal-body-edit-service_package-error">
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
            <div class="modal-body" id="modal-body-edit-service_package-roller">
                <div style="display:block;" class="text-center">
                    <br>
                    <br>
                    <div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
                    <br>
                    <br>
                    <br>
                </div>
            </div>
            <div class="modal-body d-none" id="modal-body-edit-service_package">
                <form action="" method="POST" id="formeditservice_package">
                    @csrf
                    @method('PUT')
                    <div class="mb-2">
                        <label for="name" class="form-label mb-0 ps-3">Nombre</label>
                        <input type="text" class="form-control validate" name="name" placeholder="" required value="{{ old('name') }}">
                    </div>
                    <div class="mb-2">
                        <label for="observations" class="form-label mb-0 ps-3 fw-bold">Descripcion</label>
                        <input type="text" class="form-control" name="observations" value="{{ old('observations') }}">
                    </div>
                    <div class="row p-2 mb-3">
                        <div class="col-12 col-md-6">
                            <div class="">
                                <label for="services_edit" class="form-label mb-0 ps-3 fw-bold">Servicio</label>
                                <select class="form-select" id="services_edit" onchange="getServiceDetails_edit(this)"> 
                                    <option value="" selected class="select-empty" style="color: #aaa;">Seleccione una opcion ...</option>
                                    @foreach($services as $service)
                                        <option value="{{ $service->id }}">{{ $service->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="">
                                <label for="services-description" class="form-label mb-0 ps-3 fw-bold">
                                    Descripcion
                                    <span class="d-none spinner-description">
                                        <div class="spinner-border spinner-border-sm text-primary" role="status"></div>
                                    </span>
                                </label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" id="services-description_edit">
                                    <button class="btn btn-type1 p-1" type="button" onclick="addServiceTable_edit()">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="services-currency_edit">
                        <input type="hidden" id="services-price_edit">
                        
                    </div>
                
                    <div class="table-responsive">
                        <table class="table table-sm table-hover align-middle text-center" id="table-services_edit">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Servicio</th>
                                    <th scope="col">Descripcion</th>
                                    <th scope="col">Moneda</th>
                                    <th scope="col">Precio</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody id="services-table-tbody_edit">
                            </tbody>
                        </table>
                    </div>
                    <input type="hidden" name="servicios" id="servicios_agregados_edit" value="{}">
                </form>
            </div>
            <div class="modal-footer d-none" id="modal-footer-edit-service_package">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-type1" id="btn-update-service_package">Actualizar</button>
            </div>
        </div>
    </div>
</div>