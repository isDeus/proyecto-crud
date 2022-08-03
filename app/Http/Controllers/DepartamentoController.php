<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DepartamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos['departamentos']=Departamento::paginate(1);
        return view('departamento.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('departamento.create');
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
            'Nombre'=>'required|string|max:100',
            'Codigo'=>'required|string|max:100',
        ];
        $mensaje=[
            'required'=>'El :attribute es requerido',
        ];

        $this->validate($request, $campos, $mensaje);

        $datosDepartamento = $request->except('_token');

        Departamento::insert($datosDepartamento);

        return redirect('departamento')->with('mensaje','Departamento agregado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Departamento  $departamento
     * @return \Illuminate\Http\Response
     */
    public function show(Departamento $departamento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Departamento  $departamento
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $departamento=Departamento::findOrFail($id);
        return view('departamento.edit', compact('departamento'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Departamento  $departamento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $campos=[
            'Nombre'=>'required|string|max:100',
            'Codigo'=>'required|string|max:100',
        ];

        $mensaje=[
            'required'=>'El :attribute es requerido',
        ];

        $this->validate($request, $campos, $mensaje);

        $datosDepartamento = request()->except(['_token','_method']);

        Departamento::where('id','=',$id)->update($datosDepartamento);

        $departamento=Departamento::findOrFail($id);

        return redirect('departamento')->with('mensaje', 'Departamento Modificado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Departamento  $departamento
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $departamento=Departamento::findOrFail($id);
        Departamento::destroy($id);
        return redirect('departamento')->with('mensaje', 'Departamento Borrado');
    }
}
