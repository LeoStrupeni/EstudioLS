<div class="headpdf">
    @if ($page == 1)
        <div class="row">
            <div class="span8" style="padding-top: 4rem;padding-left: 2.5rem;">
                <p class="mb-4" style="font-size: 2.3rem!important;">PRESUPUESTO</p>
                <p class="questrial-regular" style="font-size: 1.2rem!important;"> {{date('d/m/Y',strtotime($budget->fecha))}} - Válido por {{ $budget->valid }} días</p>
            </div>
            <div class="span3" style="padding-top: 0.3rem; padding-left: 1.5rem;">
                <p style="text-align:right;"><small>Página {{$page}}</small></p>
                <img style="position: relative; top: -1rem;" width="180" src="{{$logo}}" alt="">
            </div>
        </div>
            
    @else
        <div class="row">
            <div class="span8" style="padding-top: 3rem;padding-left: 2.5rem;">
            </div>
            <div class="span3" style="padding-top: 0.3rem; padding-left: 1.5rem;">
                <p class="questrial-regular" style="text-align:right;"><small>Página {{$page}}</small></p>
                <img style="position: relative; top: -1rem;" width="180" src="{{$logo}}" alt="">
            </div>
        </div>
    @endif
</div>

