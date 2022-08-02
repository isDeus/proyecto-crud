@extends('layouts.app')

@section('content')
<div class="container">

{{-- Si hay un mensaje, muestra ese mensaje --}}
{{-- Se le añade un estilo para mostrar el mensaje de forma visible --}}

@if (Session::has('mensaje'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{Session::get('mensaje')}}

    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif


{{-- Se usa una clase de bootstrap para darle más detalle --}}
<a href="{{url('empleado/create')}}" class="btn btn-success">Registrar nuevo empleado</a>
<br>
<br>

<table class="table table-light">

    <thead class="thead-light">
        <tr>
            <th>#</th>
            <th>Foto</th>
            <th>Nombre</th>
            <th>Apellido Paterno</th>
            <th>Apellido Materno</th>
            <th>Correo</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>
        {{-- Se reciben los datos desde el index del controller --}}
        @foreach ( $empleados as $empleado)
        <tr>
            <td>{{$empleado->id}}</td>


            <td>
                {{-- Se muestra la imagen que está en storage y que tiene la ruta en empleado -> foto --}}
                <img src="{{asset('storage').'/'.$empleado->Foto}}" width="100" alt="" class="img-thumbnail img-fluid">
            </td>

            <td>{{$empleado->Nombre}}</td>
            <td>{{$empleado->ApellidoPaterno}}</td>
            <td>{{$empleado->ApellidoMaterno}}</td>
            <td>{{$empleado->Correo}}</td>
            <td>

            {{-- Se genera un href que redirige hacia la url de empleado + id + edit  --}}
            <a href="{{ url('/empleado/'.$empleado->id.'/edit') }}" class="btn btn-warning">
                Editar
            </a>

            |

            {{-- Se crea un boton que envia la información a empleado junto con id a través de un post --}}
            <form action="{{ url('/empleado/'.$empleado->id) }}" method="POST" class="d-inline">
            @csrf {{-- llave para que laravel recepcione los datos --}}
            {{-- Se modifica el método desde un post a un delete para poder borrar --}}
            {{method_field('DELETE')}}
            {{-- Botón de confirmación de delete --}}
            <input type="submit" onclick="return confirm('¿Quieres borrar?')" value="Borrar" class="btn btn-danger">
            </form>

            </td>
        </tr>
        @endforeach
    </tbody>

</table>
</div>
@endsection
