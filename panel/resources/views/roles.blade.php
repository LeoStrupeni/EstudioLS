@extends('layout')

@section('link_by_page')
@endsection
@section('style_by_page')
@endsection

@section('Content')
    <div class="container-fluid">
        <div class="row justify-content-center my-4">
            <div class="col-12 col-lg-10 bg-white rounded p-2">
                <div class="row align-items-center  justify-content-between">
                    <div class="col">
                        <h5 class="navbar-brand ps-2">Roles</h5>
                    </div>
                    <div class="col">
                        <button type="button" class="btn btn-type1 float-end mx-1" onclick="callregister('/roles/table',1,$('#table_limit').val(),$('#table_order').val(),'si')"><i class="fa-solid fa-arrows-rotate"></i></button>
                        @if (in_array('create',Session::get('user')['permissions']['roles']))
                            <button type="button" class="btn btn-type1 float-end mx-1 create"><i class="fa-solid fa-plus"></i></button>
                        @endif
                        
                    </div>
                </div>
                
                <hr class="m-1" style="color: black;">

                @include('Layout.errors')

                <div class="row my-3 align-items-center justify-content-between">
                    <div class="col-5 col-md-3 col-lg-2">
                        <select class="form-select form-select-sm" id="table_limit">
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                    <div class="col-7 col-lg-6">
                        <div class="w-100 float-end" style="position: relative;padding: 0;">
							<input type="text" class="form-control form-control-sm" placeholder="¿Qué buscas?" id="table_search">
							<span style="position: absolute; height: 100%; display: -webkit-box; display: -ms-flexbox; display: flex; -webkit-box-pack: center;-ms-flex-pack: center;justify-content: center;top: 7px;width: 3.2rem;right: 0;">
								<span><i class="flaticon2-search-1"></i></span>
							</span>
						</div>
                    </div>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-sm table-hover table-bordered text-center sortable" id="table">
                        <thead class="table-type1">
                            <tr>
                                <th class="column_orden" data-name="name">Nombre</th>
                                <th class="column_orden" data-name="description">Descripcion</th>
                                <th class="column_orden" data-name="estatus">Estado</th>
                                <th class="sorttable_nosort" style="width:3%;"></th>
                            </tr>
                        </thead>
                        <tbody id="table_body" class="table-group-divider">

                        </tbody>
                    </table>
                    @include('Layout.tables.roller')
                </div>
                @include('Layout.tables.small')
                @include('Layout.tables.info')
            </div>
        </div>
    </div>
    
    {{-- @include('home.foot') --}}
    @include('rol.create')
    @include('rol.edit')
    @include('rol.show')
    @include('destroyforms')
    @include('rol.users')
    @include('rol.permisos')
@endsection

@section('script_by_page')
    <script> const routepermisos = "{{ route('updaterolpermission') }}";</script>
    <script src="{{env('APP_URL')}}/assets/js/local/rol.js"></script>
@endsection



