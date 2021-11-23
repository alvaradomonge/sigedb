<?php

namespace App\Http\Controllers;

use App\Controllers\Rel_anio_periodo_controller;
use App\Http\Requests\SavePeriodoRequest;
use App\Models\anio_lectivo;
use App\Models\periodo;
use App\Models\rel_anio_periodo;
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
        $anio_lectivo = anio_lectivo::all();
        return view('periodo.create',compact('anio_lectivo'))->with('periodo',new periodo);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SavePeriodoRequest $request,anio_lectivo $anio_lectivo)
    {
        $id=periodo::create($request->validated())->id;
        $rel= new rel_anio_periodo;
        $rel->id_periodo=$id;
        $rel->id_anio=$anio_lectivo->id;
        route('rel_anio_periodo.store',['rel'=>'rel']);
        return redirect()->route('admin.gestionAniosPeriodos')->with('status',$anio_lectivo);
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
