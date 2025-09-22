<div class="bodypdf">
    @if ($page == 1)
        <div class="span11"> 
            <div class="fs-3" style="margin: 4rem 2rem;">Cliente: {{$client->first_name}} {{$client->last_names}}</div>
        </div>

        <div class="span12" style="margin: 1rem 1rem;">
            <table style="width:100%">
                <tr>
                    <th colspan="2" class="separatedtable" style="background-color: #f6f1ef !important;"> 
                        <p class="fs-5 m-0"><b class="montserrat-family">Descripción y costo de tramites</b></p>
                    </th>
                </tr>

                @foreach ($budget_items as $item)
                    <tr>
                        <td class="separatedtable" style="background-color: #f6f1ef !important;">
                            <p class="montserrat-family fs-5 m-0">{{$item->name}}</p>
                        </td>
                        <td class="separatedtable" style="background-color: #f6f1ef !important;">
                            <p class="montserrat-family fs-5 m-0" style="text-align: center !important;">
                                @if ($item->type_money == 'dolar') USD @elseif($item->type_money == 'peso') ARS @elseif($item->type_money == 'jus') JUS @endif {{$item->price}}
                            </p>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="span11 p-3"> 
            <div class="montserrat-family m-3 fs-5" style="text-align: justify !important; ">
                
                {!! str_replace("<p>", "", $budget->observations) !!}
            
            </div>
        </div>
    @elseif($page == 2)
        
        <div class="span11 fs-4 text-wrap ps-5 pt-5" style="text-align: justify !important;"> 
            <div class="merriweather-sans-family fs-4 my-3" style="font-weight: 500; font-style: italic;"><u>INCLUYE:</u></div>
            <div class="ps-4 pe-2 fs-5 montserrat-family">{!! str_replace("<p>", "", $budget->includes) !!}</div>
        </div>
        <div class="span11 fs-4 text-wrap ps-5 pt-5" style="text-align: justify !important;">
            <div class="merriweather-sans-family fs-4 my-3" style="font-weight: 500; font-style: italic;"><u>NO INCLUYE:</u></div>
            <div class="ps-4 pe-2 fs-5 montserrat-family">{!! str_replace("<p>", "", $budget->not_includes) !!}</div>
        </div>
    @elseif($page == 3)
        
        <div class="span11 fs-4 px-5 text-wrap mb-5" > 
            <div class="my-3 fs-2" style="font-weight: 500; text-align: center;">
                <u class="merriweather-sans-family">FORMAS DE PAGO</u>
            </div>
            <div class="px-2 montserrat-family fs-5" style="text-align: justify !important;">{!! str_replace("<p>", "", $budget->payment_methods) !!}</div>
        </div>

        <div class="span11 fs-4 px-5 text-wrap">
            <div class="my-3 fs-2" style="font-weight: 500; text-align: center;">
                <u class="merriweather-sans-family">ACLARACIONES</u>
            </div>
            <div class="px-2 montserrat-family fs-5" style="text-align: justify !important;">{!! str_replace("<br>","<br><br>",str_replace("<br />","<br /><br />",str_replace("<p>", "", $budget->clarifications))) !!}</div>
        </div>
    @endif
</div>