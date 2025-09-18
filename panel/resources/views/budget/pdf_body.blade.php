<div class="col-12 bodypdf">
    <div class="row">
        @if ($page == 1)
            <div class="col-11"> 
                <h4 class="domine-family mx-3 my-5">Cliente: {{$client->first_name}} {{$client->last_names}}</h4>
            </div>

            <div class="col-11 mx-3 domine-family">
                <table style="width:100%">
                    <tr>
                        <th colspan="2" style="background-color: #f6f1ef !important;"> 
                            <p class="domine-family fs-5 m-0">Descripción y costo de tramites</p>
                        </th>
                    </tr>

                    @foreach ($budget_items as $item)
                        <tr>
                            <td style="background-color: #f6f1ef !important;">
                                <p class="domine-family fs-5 m-0">{{$item->name}}</p>
                            </td>
                            <td style="background-color: #f6f1ef !important;">
                                <p class="domine-family fs-5 m-0">
                                    @if ($item->type_money == 'dolar') USD @elseif($item->type_money == 'peso') ARS @elseif($item->type_money == 'jus') JUS @endif{{$item->price}}
                                </p>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <div class="col-11"> 
                <h4 class="montserrat-family m-3" style="text-align: justify !important;font-weight: 300;">{!! $budget->observations !!}</h4>
            </div>
        @elseif($page == 2)
            
            <div class="col-11 montserrat-family fs-4 text-wrap ms-2 mt-3" style="text-align: justify !important;"> 
                <h4 class="merriweather-sans-family my-3" style="font-weight: 500;"><u>INCLUYE:</u></h4>
                <div class="ps-4 pe-2">{!! $budget->includes !!}</div>
            </div>
            <div class="col-11 montserrat-family fs-4 text-wrap ms-2 mt-3" style="text-align: justify !important;"> 
                <h4 class="merriweather-sans-family my-3" style="font-weight: 500;"><u>NO INCLUYE:</u></h4>
                <div class="ps-4 pe-2">{!! $budget->not_includes !!}</div>
            </div>
        @elseif($page == 3)
            
            <div class="col-11 montserrat-family fs-4 text-wrap" style="text-align: justify !important;"> 
                <h2 class="text-center merriweather-sans-family my-3" style="font-weight: 500;"><u>FORMAS DE PAGO</u></h2>
                <div class="px-2">{!! $budget->payment_methods !!}</div>
            </div>

            <div class="col-11 montserrat-family fs-4 text-wrap" style="text-align: justify !important;">
                <h2 class="text-center merriweather-sans-family my-3" style="font-weight: 500;"><u>ACLARACIONES</u></h2>
                <div class="px-2">{!! $budget->clarifications !!}</div>
            </div>
        @endif
    </div>
</div>