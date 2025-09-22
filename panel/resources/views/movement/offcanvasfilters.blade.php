<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasFiltersMovs" aria-labelledby="offcanvasFiltersMovsLabel">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="offcanvasFiltersMovsLabel">Filtros</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body" id="filtermovements">
        <div class="mb-3">
            <label for="fecha" class="form-label">Periodo</label>
            <?php $valorFechaRango= ''; $valorFechaRango = $fechaRango;?>
            <input type='text' class="form-control form-control-sm text-center" name="fecha" id="fecha" readonly value="{{$valorFechaRango}}">
        </div>
        <div class="mb-3">
            <label for="type" class="form-label">Tipo Mov.</label>
            <select class="form-select form-select-sm" id="type" name="type" data-placeholder="Todos" multiple>
                <option value="egreso">Egreso</option>
                <option value="ingreso">Ingreso</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="type_money" class="form-label">Moneda</label>
            <select class="form-select form-select-sm" id="type_money" name="type_money" data-placeholder="Todas" multiple>
                <option value="dolar">Dolar</option>
                <option value="peso">Peso</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="type_document" class="form-label">Tipo Doc.</label>
            <select class="form-select form-select-sm" id="type_document" name="type_document" data-placeholder="Todos" multiple>
                @foreach ($types_doc_movement as $mov)
                    <option value="{{$mov->id}}" data-type="{{$mov->type}}">{{$mov->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="type_payment" class="form-label">Tipo Pago</label>
            <select class="form-select form-select-sm" id="type_payment" name="type_payment" data-placeholder="Todos" multiple>
                <option value="efectivo">Efectivo</option>
                <option value="transferencia">Transferencia</option>
                <option value="credito">Crédito</option>
                <option value="mercadopago">Mercado Pago</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="clients_filter" class="form-label">Clientes</label>
            <select class="form-select form-select-sm" id="clients_filter" name="client_id" data-placeholder="Todos" multiple>
                @foreach ($clients as $client)
                    <option value="{{$client->id}}">{{$client->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="budgets_filter" class="form-label">Presupuestos</label>
            <select class="form-select form-select-sm" id="budgets_filter" name="budget_id" data-placeholder="Todos" multiple>
                @foreach ($budgets as $budget)
                    <option value="{{$budget->id}}">{{$budget->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="providers_filter" class="form-label">Proveedores</label>
            <select class="form-select form-select-sm" id="providers_filter" name="provider_id" data-placeholder="Todos" multiple>
                @foreach ($providers as $provider)
                    <option value="{{$provider->id}}">{{$provider->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="users_filter" class="form-label">Usuarios</label>
            <select class="form-select form-select-sm" id="users_filter" name="user_id" data-placeholder="Todos" multiple>
                @foreach ($users as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>