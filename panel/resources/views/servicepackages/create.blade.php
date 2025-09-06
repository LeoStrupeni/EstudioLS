<div class="modal fade" id="createservice_package" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true" >
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" style="min-width: 95%!important;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nuevo Paquete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" id="formnewservice_package">
                    @csrf
                    <div class="mb-2">
                        <label for="name" class="form-label mb-0 ps-3">Nombre</label>
                        <input type="text" class="form-control validate" name="name" id="name" placeholder="" required value="{{ old('name') }}">
                    </div>
                    <div class="mb-2">
                        <label for="observations" class="form-label mb-0 ps-3 fw-bold">Descripcion</label>
                        <input type="text" class="form-control" name="observations" id="observations" value="{{ old('observations') }}">
                    </div>
                    <div class="row p-2 mb-3">
                        <div class="col-12 col-md-6">
                            <div class="">
                                <label for="services" class="form-label mb-0 ps-3 fw-bold">Servicio</label>
                                <select class="form-select" id="services" onchange="getServiceDetails(this)"> 
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
                                    <input type="text" class="form-control" id="services-description">
                                    <button class="btn btn-type1 p-1" type="button" onclick="addServiceTable()">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="services-currency">
                        <input type="hidden" id="services-price">
                        
                    </div>
                
                    <div class="table-responsive">
                        <table class="table table-sm table-hover align-middle text-center" id="table-services">
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
                            <tbody id="services-table-tbody">
                            </tbody>
                        </table>
                    </div>
                    <input type="hidden" name="servicios" id="servicios_agregados" value="{}">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-type1" id="btn-create-service_package">Guardar</button>
            </div>
        </div>
    </div>
</div>