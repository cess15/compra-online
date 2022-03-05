@extends('layouts.app')

@if(Auth::user()->role_id===1)
@section('title', 'Administrador')
@endif
@if(Auth::user()->role_id==2)
@section('title', 'Vendedor')
@endif
@if(Auth::user()->role_id==3)
@section('title', 'Comprador')
@endif
@section('content')
<div class="container">

    @if(Auth::user()->role_id == 3)
        @if(session('msg'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-check"></i>Excelente</h5>
            <ul>
                <li>{{ session("msg") }}</li>
            </ul>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-check"></i>Error</h5>
            <ul>
                <li>{{ session("error") }}</li>
            </ul>
        </div>
        @endif
    @endif

    @if(Auth::user()->role_id==1)
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Lista de Ventas</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
        <div class="table-responsive">
            <table id="tableSaleProducts" class="display nowrap table table-bordered table-hover" style="width: 100%;">
                <thead>

                    <tr>
                        <th scope="col">Producto</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Vendedor</th>
                        <th scope="col">Comprador</th>
                    </tr>
                </thead>
            </table>
        </div>
    @endif

    @if(Auth::user()->role_id==2)
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Mis Ventas</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
        <div class="table-responsive">
            <table id="tableSellerProducts" class="display nowrap table table-bordered table-hover" style="width: 100%;">
                <thead>
                    <tr>
                        <th scope="col">Producto</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Comprador</th>
                        <th scope="col">Fecha de venta</th>
                    </tr>
                </thead>
            </table>
        </div>
    @endif

    @if(Auth::user()->role_id==3)
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Mis compras</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
        <div class="table-responsive">
            <table id="tableBuyerProducts" class="display nowrap table table-bordered table-hover" style="width: 100%;">
                <thead>
                    <tr>
                        <th scope="col">Producto</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Vendedor</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Fecha de compra</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
            </table>
        </div>
    @endif
</div>
@endsection
@if(Auth::user()->role_id==1)
@push('scripts')
<script type="text/javascript">
    $("#tableSaleProducts").DataTable({
        proccessing: true,
        serverSide: true,
        pageLength: 5,
        ajax: `{{ route('products.sales.data') }}`,
        type: "GET",
        autoFill: true,
        language: {
            emptyTable: "No hay información",
            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
            infoEmpty: "Mostrando 0 a 0 de 0 registros",
            infoFiltered: "(Filtrado de _MAX_ total registros)",
            lengthMenu:
                "Mostrar <select>" +
                '<option value="5">5</option>' +
                '<option value="10">10</option>' +
                '<option value="15">20</option>' +
                '<option value="20">40</option>' +
                "</select> registros",
            loadingRecords: "Cargando...",
            processing: "Procesando...",
            search: "Buscar:",
            zeroRecords: "Sin resultados encontrados",
            paginate: {
                first: "Primero",
                last: "Ultimo",
                next: "Siguiente",
                previous: "Anterior",
            },
        },
        columns: [
            { data: 'product'},
            { data: 'price'},
            { data: 'seller'},
            { data: 'buyer'},
        ],
    });
</script>
@endpush
@endif
@if(Auth::user()->role_id == 2)
@push('scripts')
<script type="text/javascript">
    $("#tableSellerProducts").DataTable({
        proccessing: true,
        serverSide: true,
        pageLength: 5,
        ajax: `{{ route('sellers.products', $value) }}`,
        type: "GET",
        autoFill: true,
        language: {
            emptyTable: "No hay información",
            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
            infoEmpty: "Mostrando 0 a 0 de 0 registros",
            infoFiltered: "(Filtrado de _MAX_ total registros)",
            lengthMenu:
                "Mostrar <select>" +
                '<option value="5">5</option>' +
                '<option value="10">10</option>' +
                '<option value="15">20</option>' +
                '<option value="20">40</option>' +
                "</select> registros",
            loadingRecords: "Cargando...",
            processing: "Procesando...",
            search: "Buscar:",
            zeroRecords: "Sin resultados encontrados",
            paginate: {
                first: "Primero",
                last: "Ultimo",
                next: "Siguiente",
                previous: "Anterior",
            },
        },
        columns: [
            { data: 'product'},
            { data: 'price'},
            { data: 'buyer'},
            { data: 'date_sold'},
        ],
    });
</script>
@endpush
@endif
@if(Auth::user()->role_id == 3)
@push('scripts')
<script type="text/javascript">
    $("#tableBuyerProducts").DataTable({
        proccessing: true,
        serverSide: true,
        pageLength: 5,
        ajax: `{{ route('buyers.products', $value) }}`,
        type: "GET",
        autoFill: true,
        language: {
            emptyTable: "No hay información",
            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
            infoEmpty: "Mostrando 0 a 0 de 0 registros",
            infoFiltered: "(Filtrado de _MAX_ total registros)",
            lengthMenu:
                "Mostrar <select>" +
                '<option value="5">5</option>' +
                '<option value="10">10</option>' +
                '<option value="15">20</option>' +
                '<option value="20">40</option>' +
                "</select> registros",
            loadingRecords: "Cargando...",
            processing: "Procesando...",
            search: "Buscar:",
            zeroRecords: "Sin resultados encontrados",
            paginate: {
                first: "Primero",
                last: "Ultimo",
                next: "Siguiente",
                previous: "Anterior",
            },
        },
        columns: [
            { data: 'product'},
            { data: 'price'},
            { data: 'seller'},
            { data: 'status'},
            { data: 'date_bought'},
            { data: 'options'},
        ],
    });
</script>
@endpush
@endif
