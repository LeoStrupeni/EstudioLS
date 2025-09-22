<div class="col-6 col-lg-3 col-xl-12 pe-2">
    <div class="alert alert-type1 px-1" role="alert">
        <h5 class="text-center alert-heading">Saldo $</h5>
        <hr>
        <table class="table-sm w-100">
            <tbody> 
                @foreach ($balances as $balance)
                    @if ($balance->type_money == 'peso')
                        <tr>
                            <td class="ps-3 pe-0"><h5>@if ($balance->type == 'client') Cli. @else Caja @endif</h5></td>
                            <td><h5 class="pe-3 text-end">{{number_format($balance->balance,2,',','.')}}</h5></td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="col-6 col-lg-3 col-xl-12 pe-2">
    <div class="alert alert-type1 px-1" role="alert">
        <h5 class="text-center alert-heading">Saldo U$S</h5>
        <hr>
        <table class="table-sm w-100">
            <tbody> 
                @foreach ($balances as $balance)
                    @if ($balance->type_money == 'dolar')
                        <tr>
                            <td class="ps-3 pe-0"><h5>@if ($balance->type == 'client') Cli. @else Caja @endif</h5></td>
                            <td><h5 class="pe-3 text-end">{{number_format($balance->balance,2,',','.')}}</h5></td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="col-6 col-lg-3 col-xl-12 pe-2">
    <div class="alert alert-type1 px-1" role="alert">
        <h5 class="text-center alert-heading">Cotización U$S</h5>
        <hr>
        <table class="table-sm w-100" id="table_cotizacion">
            <tbody> 
                <tr>
                    <td class="ps-2"><b>Sistema</b></td>
                    <td>{{$price_usd > 0 ? number_format($price_usd,2,',','.') : 'No disp.'}}</td>
                </tr>
                <tr>
                    <td class="ps-2"><b><a href="{{$origin_usd_o}}" target="_blank" class="text-dark">Oficial</a></b></td>
                    <td>{{$price_usd_o > 0 ? number_format($price_usd_o,2,',','.') : 'No disp.'}}</td>
                </tr>
                <tr>
                    <td class="ps-2"><b><a href="{{$origin_usd_b}}" target="_blank" class="text-dark">Blue</a></b></td>
                    <td>{{$price_usd_b > 0 ? number_format($price_usd_b,2,',','.') : 'No disp.'}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="col-6 col-lg-3 col-xl-12 pe-2">
    <div class="alert alert-type1 px-1" role="alert">
        <h5 class="text-center alert-heading">Valor JUS ($)</h5>
        <hr>
        <h5 class="text-center">{{number_format($price_jus,2,',','.')}}</h5>
    </div>
</div>