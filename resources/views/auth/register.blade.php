@extends('auth.app')

@section('content')
<div class="login-page">
    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="icon fas fa-exclamation-triangle"></i>Error</h5>
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="form">
        {!! Form::open(['route'=>['register'],'method'=>'POST']) !!}
        {!! Form::token() !!}
        <div class="input-group mb-3">
            <input name="per_name" type="text" class="form-control @error('per_name') is-invalid @enderror"
                value="{{ old('per_name') }}" placeholder="Primer Nombre" />
            <div class="input-group-append">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
            </div>
            @error('per_name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="input-group mb-3">
            <input name="per_second_name" type="text" class="form-control @error('per_second_name') is-invalid @enderror"
                value="{{ old('per_second_name') }}" placeholder="Segundo Nombre" />
            <div class="input-group-append">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
            </div>
            @error('per_second_name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="input-group mb-3">
            <input name="per_lastname" type="text" class="form-control @error('per_lastname') is-invalid @enderror"
                value="{{ old('per_lastname') }}" placeholder="Primer Apellido" />
            <div class="input-group-append">
                <div class="input-group-text">
                    <i class="fas fa-user"></i>
                </div>
            </div>
            @error('per_lastname')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="input-group mb-3">
            <input name="per_second_lastname" type="text" class="form-control @error('per_second_lastname') is-invalid @enderror"
                value="{{ old('per_second_lastname') }}" placeholder="Segundo Apellido" />
            <div class="input-group-append">
                <div class="input-group-text">
                    <i class="fas fa-user"></i>
                </div>
            </div>
            @error('per_second_lastname')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="input-group mb-3">
            <input name="pers_identification" type="text" class="form-control @error('pers_identification') is-invalid @enderror"
                value="{{ old('pers_identification') }}" placeholder="Número de Identificación" />
            <div class="input-group-append">
                <div class="input-group-text">
                    <i class="fas fa-id-card"></i>
                </div>
            </div>
            @error('pers_identification')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="input-group mb-3">
            <input name="email" type="text" class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email') }}" placeholder="Correo electrónico" />
            <div class="input-group-append">
                <div class="input-group-text">
                    <i class="fas fa-at"></i>
                </div>
            </div>
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <label for="role">¿Que desea hacer?</label>
        <div class="input-group mb-3">
            <select name="role" id="role" class="form-control">
                <option value="0" selected disabled>-- Seleccione --</option>
                <option value="2">Vender</option>
                <option value="3">Comprar</option>
            </select>
            <div class="input-group-append">
                <div class="input-group-text">
                    <i class="fas fa-balance-scale"></i>
                </div>
            </div>
            @error('role')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <button type="submit">Registrarse</button>
        <p class="message">¿Ya tiene una cuenta? <a href="{{ route('login') }}">Inicie sesión</a></p>
        {!! Form::close() !!}
    </div>
</div>
@endsection
