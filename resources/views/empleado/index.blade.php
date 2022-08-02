Mostrar la lista de empleados
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
                <img src="{{asset('storage').'/'.$empleado->Foto}}" alt="">
            </td>

            <td>{{$empleado->Nombre}}</td>
            <td>{{$empleado->ApellidoPaterno}}</td>
            <td>{{$empleado->ApellidoMaterno}}</td>
            <td>{{$empleado->Correo}}</td>
            <td>

            {{-- Se genera un href que redirige hacia la url de empleado + id + edit  --}}
            <a href="{{ url('/empleado/'.$empleado->id.'/edit') }}">
                Editar
            </a>

            |

            {{-- Se crea un boton que envia la información a empleado junto con id a través de un post --}}
            <form action="{{ url('/empleado/'.$empleado->id) }}" method="POST">
            @csrf {{-- llave para que laravel recepcione los datos --}}
            {{-- Se modifica el método desde un post a un delete para poder borrar --}}
            {{method_field('DELETE')}}
            {{-- Botón de confirmación de delete --}}
            <input type="submit" onclick="return confirm('¿Quieres borrar?')" value="Borrar">
            </form>
            </td>
        </tr>
        @endforeach
    </tbody>

</table>
