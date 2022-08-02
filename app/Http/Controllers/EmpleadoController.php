<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;

/* Se agregó este uso para poder hacer uso del delete en el storage (en update) */
use Illuminate\Support\Facades\Storage;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //Se crea una varible que almacenará los datos para poder consultarlos en index.blade.php
        //El paginado corresponde a una toma de los primeros x registros
        $datos['empleados']=Empleado::paginate(5);
        //Se le proporciona al index esa información a través de la variable
        return view('empleado.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('empleado.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        /* Se añade un array de datos requeridos para su inserción en la BD */
        $campos=[
            'Nombre'=>'required|string|max:100',
            'ApellidoPaterno'=>'required|string|max:100',
            'ApellidoMaterno'=>'required|string|max:100',
            'Correo'=>'required|email',
            'Foto'=>'required|max:10000|mimes:jpeg,png,jpg',
        ];
        /* Se añade el mensaje si no existe el valor requerido */
        $mensaje=[
            'required'=>'El :attribute es requerido',
            'Foto.required'=>'La foto es requerida'
        ];

        /* Se hace la validación */
        $this->validate($request, $campos, $mensaje);


        //$datosEmpleado = $request->all();
        $datosEmpleado = $request->except('_token');

        /* Si la fotografía existe se guarda en storage */
        if($request->hasFile('Foto')){
            $datosEmpleado['Foto']=$request->file('Foto')->store('uploads', 'public');
        }

        Empleado::insert($datosEmpleado);

        //return response()->json($datosEmpleado);
        /* Se hace redirección a empleado (index) que recibe un mensaje */
        return redirect('empleado')->with('mensaje','Empleado agregado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        /* Se busca la información según el ID de parámetro usando un metodo del modelo y se almacena en una variable */
        $empleado=Empleado::findOrFail($id);
        /* Se develve la vista de edit y le pasamos esa información*/
        return view('empleado.edit', compact('empleado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        /* Se añade un array de datos requeridos para su inserción en la BD */
        $campos=[
            'Nombre'=>'required|string|max:100',
            'ApellidoPaterno'=>'required|string|max:100',
            'ApellidoMaterno'=>'required|string|max:100',
            'Correo'=>'required|email',
        ];
        /* Se añade el mensaje si no existe el valor requerido */
        $mensaje=[
            'required'=>'El :attribute es requerido',
        ];

        /* El usuario no necesariamente tiene que adjuntar otra foto, se valida sólo cuando la foto existe */
        if($request->hasFile('Foto')){
            $campos=['Foto'=>'required|max:10000|mimes:jpeg,png,jpg',];
            $mensaje=['Foto.required'=>'La foto es requerida'];
        }

        /* Se hace la validación */
        $this->validate($request, $campos, $mensaje);


        /* Se reciben todos los datos a excepción del token y el método */
        $datosEmpleado = request()->except(['_token','_method']);
        /* Se hace un where comparando los id, cuando se encuentra entonces se hace un update con los nuevos datos */

        if($request->hasFile('Foto')){
            $empleado=Empleado::findOrFail($id);
            /* Se elimina la foto antigua si es que viene una foto nueva en el update */
            Storage::delete('public/'.$empleado->Foto);
            $datosEmpleado['Foto']=$request->file('Foto')->store('uploads', 'public');
        }


        Empleado::where('id','=',$id)->update($datosEmpleado);
        /* Se vuelve a buscar la información con ese id y se devuelve a ese formulario pero con los datos actualizados */
        $empleado=Empleado::findOrFail($id);

        //return view('empleado.edit', compact('empleado'));
        return redirect('empleado')->with('mensaje', 'Empleado Modificado');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */

    /* Se cambia el paremetro para recibir el id  */
    public function destroy($id)
    {
        //
        /* Se busca la información, después se intenta borrar fisicamente desde la url que incluye empleado foto */
        $empleado=Empleado::findOrFail($id);
        if(Storage::delete('public/'.$empleado->Foto)){
            /* Utiliza el parametro $id que viene desde index.blade.php para eliminar */
            Empleado::destroy($id);
        }


        /* Se devuelve una redirección a empleado */
        return redirect('empleado')->with('mensaje', 'Empleado Borrado');
    }
}
