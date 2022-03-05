@extends('layouts.app')

@if(Auth::user()->role_id === 1)
@section('title', 'Administrador')
@endif

@if(Auth::user()->role_id === 2)
@section('title', 'Vendedor')
@endif

@if(Auth::user()->role_id === 3)
@section('title', 'Comprador')
@endif

@section('content')
<div class="container">
    @if(Auth::user()->role_id == 2 || Auth::user()->role_id == 3)
        @if(session('msg'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-check"></i>Excelente</h5>
            <ul>
                <li>{{ session("msg") }}</li>
            </ul>
        </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5>
                        <i class="icon fas fa-exclamation-triangle"></i>
                        Error
                    </h5>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    @endif

    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Lista de Productos</h1>
        </div><!-- /.col -->
    </div><!-- /.row -->
    @if(Auth::user()->role_id == 1)
    <div class="row mb-2">
        <div class="col-md-6">
            <a href="{{ route('products.create')}}" class="btn btn-primary"><i class="fa fa-plus"><span
                        class="ml-2">Nuevo producto</span></i></a>
        </div>
    </div>
    @endif
    <div class="table-responsive">
        <table id="tableProducts" class="display nowrap table table-bordered table-hover" style="width: 100%;">
            <thead>

                <tr>
                    <th scope="col">Categoria</th>
                    <th scope="col">Producto</th>
                    <th scope="col">Precio</th>
                    @if(Auth::user()->role_id == 3)
                    <th scope="col">Vendedor</th>
                    <th scope="col">Estado</th>
                    @endif
                    <th scope="col">Opciones</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection
@if(Auth::user()->role_id == 3)
@push('scripts')
<script type="text/javascript">
    $("#tableProducts").DataTable({
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
            { data: 'category'},
            { data: 'product'},
            { data: 'price'},
            { data: 'seller'},
            { data: 'status'},
            { data: 'options'},
        ],
    });
</script>
@endpush
@endif
@if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
@push('scripts')
<script type="text/javascript">
    $("#tableProducts").DataTable({
        proccessing: true,
        serverSide: true,
        pageLength: 5,
        ajax: `{{ route('products.data') }}`,
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
            { data: 'category'},
            { data: 'product'},
            { data: 'price'},
            { data: 'options'},
        ],
    });
</script>
@endpush
@endif
