<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasFiltersMovs" aria-labelledby="offcanvasFiltersMovsLabel">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="offcanvasFiltersMovsLabel">Filtros</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body" id="filtermovements">
        <div class="mb-3">
            <label for="fecha" class="form-label">Periodo</label>
            <?php $valorFechaRango= ''; $valorFechaRango = $fechaRango;?>
            <input type='text' class="form-control text-center" name="fecha" id="fecha" readonly value="{{$valorFechaRango}}">
        </div>
        <div class="mb-3">
            <label for="type" class="form-label">Tipo Mov.</label>
            <select class="form-select" id="type" name="type" data-placeholder="Todos" multiple>
                <option value="egreso">Egreso</option>
                <option value="ingreso">Ingreso</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="type_money" class="form-label">Moneda</label>
            <select class="form-select" id="type_money" name="type_money" data-placeholder="Todas" multiple>
                <option value="dolar">Dolar</option>
                <option value="peso">Peso</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="type_document" class="form-label">Tipo Doc.</label>
            <select class="form-select" id="type_document" name="type_document" data-placeholder="Todos" multiple>
                @foreach ($types_doc_movement as $mov)
                    <option value="{{$mov->id}}" data-type="{{$mov->type}}">{{$mov->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="type_payment" class="form-label">Tipo Pago</label>
            <select class="form-select" id="type_payment" name="type_payment" data-placeholder="Todos" multiple>
                <option value="efectivo">Efectivo</option>
                <option value="transferencia">Transferencia</option>
                <option value="credito">Crédito</option>
                <option value="mercadopago">Mercado Pago</option>
            </select>
        </div>
    </div>
</div>