<?php

namespace App\Http\Controllers;

use App\Models\periodo;
use App\Models\anio_lectivo;
use App\Controllers\Rel_anio_periodo_controller;
use Illuminate\Http\Request;

class PeriodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $anio = anio_lectivo::latest('nombre');
        return view('periodo.create',['periodo' => new periodo,'anio_lectivo'=>$anio]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        periodo::create($request->validated());

        return redirect()->route('admin.gestionAniosPeriodos')->with('status','Periodo creado exitósamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\periodo  $periodo
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('Estudiante.show',[
            'estudiante'=>Estudiante::findOrFail($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\periodo  $periodo
     * @return \Illuminate\Http\Response
     */
    public function edit(periodo $periodo)
    {
        return view('periodo.edit',[
            'periodo' => $periodo,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\periodo  $periodo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, periodo $periodo)
    {
        $periodo->update($request->validated());
        return redirect()->route('periodo.show',$periodo)->with('status','Actualización completada exitósamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\periodo  $periodo
     * @return \Illuminate\Http\Response
     */
    public function destroy(periodo $periodo)
    {
        $periodo->delete();
        return redirect()->route('admin.gestionAniosPeriodos')->with('status','Se ha realizado la eliminación');
    }
}
