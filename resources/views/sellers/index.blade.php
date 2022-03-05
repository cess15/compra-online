@extends('layouts.app')

@if(Auth::user()->role_id===1)
@section('title', 'Administrador')
@endif

@section('content')
<div class="container">
    @if(Auth::user()->role_id==1)
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Lista de Vendedores</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
        <div class="table-responsive">
            <table id="tableSellers" class="display nowrap table table-bordered table-hover" style="width: 100%;">
                <thead>

                    <tr>
                        <th scope="col">Vendedor</th>
                        <th scope="col">Productos Vendidos</th>
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
    $("#tableSellers").DataTable({
        proccessing: true,
        serverSide: true,
        pageLength: 5,
        ajax: `{{ route('sellers.data') }}`,
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
            { data: 'seller'},
            { data: 'products'},
        ],
    });
</script>
@endpush
@endif
