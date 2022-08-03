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
<a href="{{url('equipo/create')}}" class="btn btn-success">Registrar nuevo equipo</a>
<br>
<br>

<table class="table table-light">

    <thead class="thead-light">
        <tr>
            <th>#</th>
            <th>ID Departamento</th>
            <th>Nombre</th>
            <th>Código</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>
        {{-- Se reciben los datos desde el index del controller --}}
        @foreach ( $equipos as $equipo)
        <tr>
            <td>{{$equipo->id}}</td>
            <td>{{$equipo->departamento_id}}</td>
            <td>{{$equipo->Nombre}}</td>
            <td>{{$equipo->Codigo}}</td>

            <td>

            {{-- Se genera un href que redirige hacia la url de equipo + id + edit  --}}
            <a href="{{ url('/equipo/'.$equipo->id.'/edit') }}" class="btn btn-warning">
                Editar
            </a>

            |

            {{-- Se crea un boton que envia la información a equipo junto con id a través de un post --}}
            <form action="{{ url('/equipo/'.$equipo->id) }}" method="POST" class="d-inline">
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
{{ $equipos->links() }}
</div>
@endsection
