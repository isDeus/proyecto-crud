{{-- Formulario de equipo que es reutilizado en otras partes --}}
{{-- Se añaden los values en cada input para recibir (si es que existen) los valores y así poder mostrarlos --}}
{{-- Se refactorizó para mostrar o no los valores si es que existen (con isset) --}}
<h1>{{$modo}} equipo</h1>

{{-- Se muestran los errores de forma estética si no se han rellenado ciertos campos --}}
@if (count($errors)>0)

    <div class="alert alert-danger" role="alert">
        <ul>
        @foreach ($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
        </ul>
    </div>

@endif

<div class="form-group">
<label for="departamento_id">ID de Departamento</label>
<input type="text" name="departamento_id" value="{{ isset($equipo->departamento_id)?$equipo->departamento_id:old('departamento_id')}}" id="departamento_id" class="form-control">
</div>

<div class="form-group">
<label for="Nombre">Nombre</label>
<input type="text" name="Nombre" value="{{ isset($equipo->Nombre)?$equipo->Nombre:old('Nombre')}}" id="Nombre" class="form-control">
</div>

<div class="form-group">
<label for="Codigo">Codigo</label>
<input type="text" name="Codigo" value="{{ isset($equipo->Codigo)?$equipo->Codigo:old('Codigo')}}" id="Codigo" class="form-control">
</div>

<br>

<input type="submit" value="{{$modo}} datos" class="btn btn-success">

<a href="{{url('equipo/')}}" class="btn btn-primary">Regresar</a>

<br>
