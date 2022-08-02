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
        //$datosEmpleado = $request->all();
        $datosEmpleado = $request->except('_token');

        /* Si la fotografía existe se guarda en storage */
        if($request->hasFile('Foto')){
            $datosEmpleado['Foto']=$request->file('Foto')->store('uploads', 'public');
        }

        Empleado::insert($datosEmpleado);

        return response()->json($datosEmpleado);
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
        return view('empleado.edit', compact('empleado'));

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
        return redirect('empleado');
    }
}
