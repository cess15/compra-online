@extends('layouts.app')

@if(Auth::user()->role_id===1)
@section('title', 'Administrador')
@endif

@section('content')
<div class="container">
    @if(Auth::user()->role_id==1)
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Lista de Categorias</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
        <div class="row mb-2">
            <div class="col-md-6">
                <a href="{{ route('categories.create')}}" class="btn btn-primary"><i class="fa fa-plus"><span
                            class="ml-2">Nueva categoria</span></i></a>
            </div>
        </div>
        <div class="table-responsive">
            <table id="tableCategories" class="display nowrap table table-bordered table-hover" style="width: 100%;">
                <thead>

                    <tr>
                        <th scope="col">Categoria</th>
                        <th scope="col">Productos</th>
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
    $("#tableCategories").DataTable({
        proccessing: true,
        serverSide: true,
        pageLength: 5,
        ajax: `{{ route('categories.data') }}`,
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
            { data: 'products'},
        ],
    });
</script>
@endpush
@endif
