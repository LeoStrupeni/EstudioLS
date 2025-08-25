var controladorTiempo = 3000;
var varsearch = '';
const formatter = new Intl.NumberFormat('es-AR', {minimumFractionDigits: 2,maximumFractionDigits: 2});

$(document).ready(function() {
    $( '#type_document, #type_payment, #type_money, #type' ).select2( {
        theme: "bootstrap-5",
        width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
        placeholder: $( this ).data( 'placeholder' ),
        closeOnSelect: false,
    } );
    $( '#type_document, #type_payment, #type_money, #type' ).change(function(){
        get_filters_applied(); 
        callregister('/movement/table',1,$('#table_limit').val(),$('#table_order').val(),'si');
    });
    
    $('#fecha').daterangepicker({
        buttonClasses: ' btn',
        applyClass: 'btn-primary',
        cancelClass: 'btn-secondary',
        autoUpdateInput : false,
        locale: {"applyLabel": "Aplicar","cancelLabel": "Limpiar","fromLabel": "Desde","toLabel": "hasta",
        "customRangeLabel": "Custom","daysOfWeek": ["Do","Lu","Ma","Mi","Ju","Vi","Sa"],
        "monthNames": ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre",
        "Octubre","Noviembre","Diciembre"],"firstDay": 1
        }
    });

    $('#fechaC').datepicker("setDate", new Date());

    $('#fecha').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
        callregister('/movement/table',1,$('#table_limit').val(),$('#table_order').val(),'si');
        get_filters_applied();
    });

    $('#fecha').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
        callregister('/movement/table',1,$('#table_limit').val(),$('#table_order').val(),'si');
        get_filters_applied();
    });

    get_filters_applied();

    function get_filters_applied(){
        $('#filtrosaplicados').empty();
        fecha=$('#fecha').val();
        type=$('#type').val();
        money=$('#type_money').val();
        doc=$('#type_document').val();
        pay=$('#type_payment').val();

        var f_fecha = '', f_type='', f_money='' , f_doc='', f_pay='';
        if(fecha!='') {f_fecha=`<li><b>Periodo: </b>${fecha}</li>`;}
        if(type!=''){
            f_type=`<li><b>Tipos de Movimientos: </b>`;
            $.each(type, function (key, val) {
                if( f_type=='<li><b>Tipos de Movimientos: </b>'){ f_type+=` ${val}`;}
                else { f_type+=`, ${val}`;}
            });
            f_type+=`</li>`;
        }
        if(money!=''){
            f_money=`<li><b>Monedas: </b>`;
            $.each(money, function (key, val) {
                if( f_money=='<li><b>Monedas: </b>'){ f_money+=` ${val}`;}
                else { f_money+=`, ${val}`;}
            });
            f_money+=`</li>`;
        }
        if(doc!=''){
            f_doc=`<li><b>Tipos de Documentos: </b>`;
            $.each(doc, function (key, val) {
                if( f_doc=='<li><b>Tipos de Documentos: </b>'){f_doc+=` ${val}`;}
                else {f_doc+=`, ${val}`;}
            });
            f_doc+=`</li>`;
        }
        if(pay!=''){
            f_pay=`<li><b>Tipos de Pago: </b>`;
            $.each(pay, function (key, val) {
                if( f_pay=='<li><b>Tipos de Pago: </b>'){ f_pay+=` ${val}`;}
                else { f_pay+=`, ${val}`;}
            });
            f_pay+=`</li>`;
        }

        if(fecha!='' || type!='' || money!='' || doc!='' || pay!='' ){
            $('#filtrosaplicados').append(`<div class="alert alert-danger py-2" role="alert">
                <ul class="mb-0"> 
                    ${f_fecha}
                    ${f_type}
                    ${f_money}
                    ${f_doc}
                    ${f_pay}
                </ul>
            </div>`);
        }

    }

    callregister('/movement/table',1,$('#table_limit').val(),$('#table_order').val(),'si');
    $('body').on('click','.create',function(){ 
        $('#name').val('');
        $('#description').val('');
        $('#createmovement').modal('show');
    });
    $('body').on('click','.update',function(){ 
        $('#formeditmovement').attr('action',app_url+"/movement/"+$(this).data('id'));

        form = document.getElementById("formeditmovement");
        $( form.elements ).each(function( index ) {
            if($(this).attr('name') != '_method' && $(this).attr('name') != '_token'){
                $(this).val('');
            } 
        });

        $('#editmovement').modal('show');

        $('#modal-body-edit-movement-roller').removeClass('d-none');
        $('#modal-body-edit-movement-error').addClass('d-none');
        $('#modal-body-edit-movement').addClass('d-none');
        $('#modal-footer-edit-movement').addClass('d-none');

        $.ajax({contenttype : 'application/json; charset=utf-8',
            url : $('meta[name="app_url"]').attr('content')+'/movement/'+$(this).data('id')+'/edit',
            type : 'GET',
            done : function(response) { $('#modal-body-edit-movement-error').removeClass('d-none'); },
            error : function(jqXHR,textStatus,errorThrown) { $('#modal-body-edit-movement-error').removeClass('d-none'); },
            success : function(data) {
                $.each( data , function( index, value ) {
                    $( form.elements ).each(function( b ) {
                        if($(this).attr('name') == index){
                            $(this).val(value);
                        }
                    });
                });
                $('#modal-body-edit-movement').removeClass('d-none');
                $('#modal-footer-edit-movement').removeClass('d-none');
            }
        }).always(function() {
            $('#modal-body-edit-movement-roller').addClass('d-none');
        });
    });
    $('body').on('click','.read',function(){ 
        form = document.getElementById("formshowmovement");
        $( form.elements ).each(function( index ) {
            $(this).val('');
        });
        $('#showmovement').modal('show');

        $('#modal-body-show-movement-roller').removeClass('d-none');
        $('#modal-body-show-movement-error').addClass('d-none');
        $('#modal-body-show-movement').addClass('d-none');

        $.ajax({contenttype : 'application/json; charset=utf-8',
            url : $('meta[name="app_url"]').attr('content')+'/movement/'+$(this).data('id')+'/edit',
            type : 'GET',
            done : function(response) { $('#modal-body-edit-movement-error').removeClass('d-none'); },
            error : function(jqXHR,textStatus,errorThrown) { $('#modal-body-edit-movement-error').removeClass('d-none'); },
            success : function(data) {

                $.each( data , function( index, value ) {
                    $( form.elements ).each(function( b ) {
                        if($(this).attr('name') == index){
                            if(index == 'type_doc'){
                                switch(value) {
                                    case "1": $(this).val('Dni'); break;
                                    case "2": $(this).val('Cuil'); break;
                                    case "3": $(this).val('Cuit'); break;
                                    default: $(this).val('');
                                }
                            }else {
                                $(this).val(value);
                            }
                            $(this).css('box-shadow', 'inset 0px 0px 1px 1px green');
                        }
                    });
                });

                $('#modal-body-show-movement').removeClass('d-none');
            }
        }).always(function() {
            $('#modal-body-show-movement-roller').addClass('d-none');
        });
    });
    $('body').on('click','.delete',function(){ 
        rolid=$(this).data('id');
        Swal.fire({
            title: "Borrar Movimiento",
            html: "Esta seguro que desea eliminar el movimiento "+$(this).data('name')+"?<br>No podrá revertir el cambio.",
            type: "question",
            showCancelButton: true,
            confirmButtonText: "Borrar",
            cancelButtonText: `Cancelar`,
        }).then((result) => {
            if (result.dismiss != 'cancel') {
                $('#formdestroy').attr('action',app_url+"/movement/"+$(this).data('id'));
                $('#formdestroy').submit();
            }
        });
    });

    $('body').on('change',"#type_origin_c",function () {

        $('#client_c').addClass('d-none');
        $('#provider_c').addClass('d-none');
        $('#user_c').addClass('d-none');

        $('#client_id_c').empty();
        $('#provider_id_c').empty();
        $('#user_id_c').empty();
        url_query = '';
        add_data=""

        if($(this).val() == 'client'){
            $('#client_c').removeClass('d-none');
            url_query = `/${$(this).val()}/table`;
            add_data='#client_id_c';
        }else if($(this).val() == 'provider'){
            $('#provider_c').removeClass('d-none');
            url_query = `/${$(this).val()}/table`;
            add_data='#provider_id_c';
        }else if($(this).val() == 'user'){
            $('#user_c').removeClass('d-none');
            url_query = `/${$(this).val()}s/table`;
            add_data='#user_id_c';
        }

        if(url_query != ''){
            getdataselect(url_query,add_data, null);
        }

    });
    function getdataselect(url_query,add_data, var_search){
        $('.spinner-data').removeClass('d-none');
        $.ajax({contenttype : 'application/json; charset=utf-8',
            data: {
                page	    : 1,
                limit 	    : 20,
                order 	    : null,
                search      : var_search
            },
            url : $('meta[name="app_url"]').attr('content')+url_query,
            type : 'POST',
            success : function(data) {
                selects="";
                $.each(data.datos, function (key, val) {
                    if(add_data == '#user_id_c'){
                        selects+=`<option value="${val.id}">${val.name}</option>`;
                    }else{
                        selects+=`<option value="${val.id}">${val.first_name} ${val.last_names}</option>`;
                    }
                });
                $(add_data).append(selects);
            }
        }).always(function() {
            $('.spinner-data').addClass('d-none');

            $( add_data ).select2( {
                theme: "bootstrap-5",
                width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
                placeholder: 'Seleccione una opcion',
                dropdownParent: $('#createmovement'),
                language: 'es'
            } );
            $(add_data).select2('open');
        });
    }
    $('body').on('keyup','.select2-search__field',function(){
        varsearch=this.value;
        clearInterval(controladorTiempo);
        controladorTiempo = setInterval(function () {
            url_query = '';
            add_data=""
            if($("#type_origin_c").val() == 'client'){
                $('#client_id_c').empty();
    
                $('#client_c').removeClass('d-none');
                url_query = `/${$("#type_origin_c").val()}/table`;
                add_data='#client_id_c';
            }else if($("#type_origin_c").val() == 'provider'){
                $('#provider_id_c').empty();
    
                $('#provider_c').removeClass('d-none');
                url_query = `/${$("#type_origin_c").val()}/table`;
                add_data='#provider_id_c';
            }else if($("#type_origin_c").val() == 'user'){
                $('#user_id_c').empty();
    
                $('#user_c').removeClass('d-none');
                url_query = `/${$("#type_origin_c").val()}s/table`;
                add_data='#user_id_c';
            }
            
            if(url_query != ''){
                getdataselect(url_query,add_data, varsearch);
            }
            
            clearInterval(controladorTiempo); //Limpio el intervalo
        
        }, 400);
        

    });
    $('body').on('click',"#btn-create-movement",function () {
        var error = 0
        form = document.getElementById("formnewmovement");

        $( form.getElementsByClassName('validate') ).each(function( index ) {
            if($( this ).val() == ''){
                $( this ).css('box-shadow', 'inset 0px 0px 2px 2px red');
                error++;
            } else {
                $( this ).css('box-shadow', '');
            }
        });

        if (error > 0) {
            toastr["error"]("Debe completar los datos correctamente.")
        } else {
            document.getElementById("formnewmovement").submit();
        }
    });
    $('body').on('click',"#btn-update-movement",function () {
        var error = 0

        var error = 0
        form = document.getElementById("formeditmovement");

        $( form.getElementsByClassName('validate') ).each(function( index ) {
            if($( this ).val() == ''){
                $( this ).css('box-shadow', 'inset 0px 0px 2px 2px red');
                error++;
            } else {
                $( this ).css('box-shadow', '');
            }
        });
        if (error > 0) {
            toastr["error"]("Debe completar los datos correctamente para editar el Movimiento.")
        } else {
            document.getElementById("formeditmovement").submit();
        }
    });
    $('body').on('change',"#table_limit",function () {
        callregister('/movement/table',1,$('#table_limit').val(),$('#table_order').val(),'si')
    });
    $('body').on('click',".column_orden", function(){
        var name = $(this).data('name');
        orden = name+' ASC';

        if ($(this).hasClass('sorttable_sorted'))  { orden = name+' DESC';}

        $('#table_order').val(orden);
        if($('#table_filtrados').val() != $('#table_totales').val()){
            callregister('/movement/table',1,$('#table_limit').val(),orden,'si')
        }
    });
    var controladorTiempo = 3000;
    $('#table_search').on('change, keyup',function() {            
        if($('#table_filtrados').val() != $('#table_totales').val()){   
            clearInterval(controladorTiempo);
            controladorTiempo = setInterval(function(){
                callregister('/movement/table',1,$('#table_limit').val(),$('#table_order').val(),'si')
                clearInterval(controladorTiempo); //Limpio el intervalo
            }, 800); 
           
        } else {
            _this = this;
            // Show only matching TR, hide rest of them
            $.each($("#table_body tr"), function() {
                if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
                    $(this).hide();
                else
                    $(this).show();
            });
        }
    });
});

function tableregister(data, page, callpaginas, url_query){
    body='';
    $.each(data.datos, function (key, val) {
        body += `<tr id="${val.id}">
            <td class="align-middle">${val.fecha}</td>
            <td class="align-middle">${val.type}</td>
            <td class="align-middle">${val.cliente}</td>
            <td class="align-middle">${val.type_document}</td>
            <td class="align-middle">${val.type_payment}</td>
            <td class="align-middle">${val.payment_detail ?? ''}</td>
            <td class="align-middle">${val.concepto ?? ''}</td>
            <td class="align-middle">${val.description ?? ''}</td>
            <td class="align-middle">${val.type_money}</td>
            <td class="align-middle">${formatter.format(val.deposit)}</td>
            <td class="align-middle">${formatter.format(val.expense)}</td>
            <td class="align-middle">
                <div class="dropdown">
                    <button class="btn btn-link dropdown-toggle-menu-body text-success" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-ellipsis"></i>
                    </button>
                    <ul class="dropdown-menu" >`;
                        if( data.permissions.includes('read') ) {
                            body += `<li><a href="javascript:void(0);" data-id="${val.id}" class="dropdown-item read">
                                <i class="flaticon-eye"></i> Ver
                            </a></li>`
                        }

                        if( data.permissions.includes('update') ) {
                            body += `<li><a href="javascript:void(0);" data-id="${val.id}" class="dropdown-item update">
                                <i class="flaticon-upload"></i> Editar
                            </a></li>`
                        }

                        if ( data.permissions.includes('delete') ){
                            body += `<li><a href="javascript:void(0);" data-id="${val.id}" class="dropdown-item delete" data-name="${val.first_name} ${val.last_names}">
                                <i class="flaticon-delete"></i> Eliminar
                            </a></li>`
                        }
                body += `<ul></div>
            </td>
        </tr>`;
    });
    $('#table_body').append(body);
    $('#table_info').text(data.infototal);
    $('#table_filtrados').val(data.datos.length);
    $('#table_totales').val(data.totales);
    table_filtrados
    if(callpaginas=='si'){
        document.getElementById('table_pagination').innerHTML = createPagination(data.paginastotal, page, callpaginas, url_query);
    }

    var dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle-menu-body'))
        var dropdownList = dropdownElementList.map(function (dropdownToggleEl) {
        return new bootstrap.Dropdown(dropdownToggleEl, {
            boundary: document.querySelector('#inicio'),
            popperConfig: function (defaultBsPopperConfig) {
                return {
                    ...defaultBsPopperConfig,
                    placement: "bottom-end",
                    strategy: "fixed"
                };
            }
        })
    });
}

function getlistbankaccounts(value){
    form = document.getElementById("formnewmovement");
    typemoney = form.querySelectorAll('[name="type_money"]')[0].value;
    $('[name="bank_account"]').val('');
    $( form.querySelectorAll('[name="bank_account"]')[0].children ).each(function( index ) {
        if (index > 0) {
            if($(this).data('type') != typemoney) {$(this).addClass('d-none')}
            else{$(this).removeClass('d-none')}
        }
    });

}

function labelbankaccounts(value){
    text='Cuenta';
    if (value=="ingreso") { text='Cuenta destino'; }
    else if (value=="egreso") { text='Cuenta origen';}
    $($('[name="bank_account"]').parent().children()[0]).text(text);
}

