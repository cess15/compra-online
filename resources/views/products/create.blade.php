@extends('layouts.app')
@if(Auth::user()->role_id===1)
@section('title', 'Administrador')
@endif

@section('content')
<div class="container">
    <div class="row mb-2">
        <div class="col-md-6">
            <a href="{{ route('products.index')}}" class="btn btn-primary">
                <i class="fa fa-arrow-alt-circle-left">
                    <span class="ml-2">Regresar</span>
                </i>
            </a>
        </div>
    </div>

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

    <div class="row">
        <div class="col">
            <div class="card-success">
                <div class="card-header">
                    <div class="card-title">Datos del Producto</div>
                </div>
                <div class="card-body">
                    {!! Form::open(['route' => ['products.store'] ]) !!}
                    {!! Form::token() !!}
                    <div class="row">
                        <div class="col-md-6">
                            {!! Form::label('name', 'Nombre del producto') !!}
                            {!! Form::text('name', null, ['placeholder' => 'Ingrese nombre del producto', 'class' => 'form-control']) !!}
                        </div>
                        <div class="col-md-6">
                            {!! Form::label('price', 'Precio del producto') !!}
                            {!! Form::text('price', null, ['placeholder' => 'Ingrese precio del producto', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="cateogory_id">Categoria(*)</label>
                                <select name="category_id" id="category_id" class="form-control">
                                    <option value="0" selected disabled>--Seleccione--</option>
                                    @foreach ($data as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary">Guardar datos</button>
                            <button type="reset" class="btn btn-danger">Resetear</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
