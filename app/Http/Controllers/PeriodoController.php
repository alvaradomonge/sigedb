<?php

namespace App\Http\Controllers;

use App\Http\Requests\SavePeriodoRequest;
use App\Models\anio_lectivo;
use App\Controllers\AnioLectivoController;
use App\Models\periodo;
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
        $periodo=new periodo;
        return view('periodo.create',compact('anio_lectivo','periodo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SavePeriodoRequest $request)
    {
        $id_per=periodo::create($request->validated());
        //$anio = anio_lectivo::where('id',$request->anio)->get();
        // rel_anio_periodo::create( NO SIRVE, CODIGO DE EJEMPLO
        //     [
        //         'id_anio'=>$request->anio,
        //         'id_periodo'=>$id_per->id,
        //         'es_final'=>$request->es_final,
        //         'valor_porcentual'=>$request->valor_porcentual,
        //     ]);
        return redirect()->route('admin.gestionAniosPeriodos')->with('status');
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

    public function showPeriodosActivos()
    {
        $query=periodo::find()->relacion()->where('activo',1);
        return $query;
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
