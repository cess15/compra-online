@extends('layouts.app')
@if(Auth::user()->role_id===1)
@section('title', 'Administrador')
@endif

@section('content')
<div class="container">
    <div class="row mb-2">
        <div class="col-md-6">
            <a href="{{ route('categories.index')}}" class="btn btn-primary">
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
                    <div class="card-title">Datos de la Categoria</div>
                </div>
                <div class="card-body">
                    {!! Form::open(['route' => ['categories.store'] ]) !!}
                    {!! Form::token() !!}
                    <div class="row">
                        <div class="col-md-6">
                            {!! Form::label('name', 'Nombre de la categoria') !!}
                            {!! Form::text('name', null, ['placeholder' => 'Ingrese nombre de la categoria', 'class' => 'form-control']) !!}
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
