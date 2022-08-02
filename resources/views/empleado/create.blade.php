Formulario de creación de empleado
<form action="{{url('/empleado')}}" method="post" enctype="multipart/form-data">
@csrf
{{-- Se quita el cuestionario para ponerlo en su propio archivo (así permitiendo su reutilización), se hace referencia a ese archivo con include --}}
@include('empleado.form', ['modo'=>'Crear']);

</form>
