<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\Departamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EquipoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos['equipos']=Equipo::paginate(5);
        return view('equipo.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $departamentos = Departamento::pluck('Nombre', 'id');
        return view('equipo.create', compact('departamentos'));
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
        $campos=[
            'departamento_id'=>'required|integer',
            'Nombre'=>'required|string|max:100',
            'Codigo'=>'required|string|max:100',
        ];
        $mensaje=[
            'required'=>'El :attribute es requerido',
        ];

        $this->validate($request, $campos, $mensaje);


        $datosEquipo = $request->except('_token');

        Equipo::insert($datosEquipo);

        return redirect('equipo')->with('mensaje','Equipo agregado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Equipo  $equipo
     * @return \Illuminate\Http\Response
     */
    public function show(Equipo $equipo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Equipo  $equipo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $equipo=Equipo::findOrFail($id);
        return view('equipo.edit', compact('equipo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Equipo  $equipo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $campos=[
            'ID de Departamento'=>'required|integer',
            'Nombre'=>'required|string|max:100',
            'Codigo'=>'required|string|max:100',
        ];
        $mensaje=[
            'required'=>'El :attribute es requerido',
        ];

        $this->validate($request, $campos, $mensaje);

        $datosEquipo = request()->except(['_token','_method']);

        Equipo::where('id','=',$id)->update($datosEquipo);

        $equipo=Equipo::findOrFail($id);

        return redirect('equipo')->with('mensaje', 'Equipo Modificado');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Equipo  $equipo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $equipo=Equipo::findOrFail($id);
        return redirect('equipo')->with('mensaje', 'Equipo Borrado');

    }
}
