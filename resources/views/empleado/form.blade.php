{{-- Formulario de empleado que es reutilizado en otras partes --}}
{{-- Se añaden los values en cada input para recibir (si es que existen) los valores y así poder mostrarlos --}}
{{-- Se refactorizó para mostrar o no los valores si es que existen (con isset) --}}
<label for="Nombre">Nombre</label>
<input type="text" name="Nombre" value="{{ isset($empleado->Nombre)?$empleado->Nombre:''}}" id="Nombre">
<br>

<label for="ApellidoPaterno">Apellido Paterno</label>
<input type="text" name="ApellidoPaterno" value="{{ isset($empleado->ApellidoPaterno)?$empleado->ApellidoPaterno:''}}" id="ApellidoPaterno">
<br>

<label for="ApellidoMaterno">Apellido Materno</label>
<input type="text" name="ApellidoMaterno" value="{{ isset($empleado->ApellidoMaterno)?$empleado->ApellidoMaterno:''}}" id="ApellidoMaterno">
<br>

<label for="Correo">Correo</label>
<input type="text" name="Correo" value="{{ isset($empleado->Correo)?$empleado->Correo:''}}" id="Correo">
<br>

<label for="Foto">Foto</label>
@if (isset($empleado->Foto))
<img src="{{asset('storage').'/'.$empleado->Foto}}" width="100" alt="">
@endif
<input type="file" name="Foto" value="" id="Foto">
<br>

<input type="submit" value="Guardar datos">

<a href="{{url('empleado/')}}">Regresar</a>

<br>
