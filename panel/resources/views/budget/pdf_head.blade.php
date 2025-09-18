<div class="col-12 headpdf">
    <div class="row">
        <div class="col-8 ml-4 mt-4">
            @if ($page == 1)
                <p class="merriweather-sans-family mb-1" style="font-size: 2.3rem!important;">PRESUPUESTO</p>
                <p class="questrial-regular ms-2" style="font-size: 1.2rem!important;"> {{date('d/m/Y',strtotime($budget->fecha))}} - Válido por {{ $budget->valid }} días</p>
            @endif
        </div>
        <div class="col-3 mt-3">
            <span class="float-right"><small>Página {{$page}}</small></span>
            <img class="img-fluid" style="position: relative; top: -15px;" src="{{env('APP_URL')}}/assets/media/originales/Original_lignos_seguro.png" alt="">
        </div>
    </div>
</div>

