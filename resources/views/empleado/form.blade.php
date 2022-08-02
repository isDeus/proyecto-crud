{{-- Formulario de empleado que es reutilizado en otras partes --}}
{{-- Se añaden los values en cada input para recibir (si es que existen) los valores y así poder mostrarlos --}}
{{-- Se refactorizó para mostrar o no los valores si es que existen (con isset) --}}
<h1>{{$modo}} empleado</h1>

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
<label for="Nombre">Nombre</label>
<input type="text" name="Nombre" value="{{ isset($empleado->Nombre)?$empleado->Nombre:''}}" id="Nombre" class="form-control">
</div>

<div class="form-group">
<label for="ApellidoPaterno">Apellido Paterno</label>
<input type="text" name="ApellidoPaterno" value="{{ isset($empleado->ApellidoPaterno)?$empleado->ApellidoPaterno:''}}" id="ApellidoPaterno" class="form-control">
</div>

<div class="form-group">
<label for="ApellidoMaterno">Apellido Materno</label>
<input type="text" name="ApellidoMaterno" value="{{ isset($empleado->ApellidoMaterno)?$empleado->ApellidoMaterno:''}}" id="ApellidoMaterno" class="form-control">
</div>

<div class="form-group">
<label for="Correo">Correo</label>
<input type="text" name="Correo" value="{{ isset($empleado->Correo)?$empleado->Correo:''}}" id="Correo" class="form-control">
</div>

<div class="form-group">
<label for="Foto"></label>
@if (isset($empleado->Foto))
<img src="{{asset('storage').'/'.$empleado->Foto}}" width="100" alt="" class="img-thumbnail img-fluid">
@endif
<input type="file" name="Foto" value="" id="Foto" class="form-control">
</div>

<br>

<input type="submit" value="{{$modo}} datos" class="btn btn-success">

<a href="{{url('empleado/')}}" class="btn btn-primary">Regresar</a>

<br>
