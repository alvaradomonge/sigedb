<?php

namespace App\Http\Controllers;

use App\Controllers\AnioLectivoController;
use App\Http\Requests\SavePeriodoRequest;
use App\Models\anio_lectivo;
use App\Models\grupo_guia;
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
        $query=periodo::where('activo','1')->orderBy('id_anio','desc')->get();
        //$query=periodo::all()->sortBy('anio_lectivo->nombre')->where('activo','1');
        $anio_lectivo = anio_lectivo::latest('nombre')->paginate(15);
        return view('admin.gestionAniosPeriodos',compact('anio_lectivo','query'));
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
        $grupos=grupo_guia::where('id_periodo',$id)->get();
        return view('Periodo.show',[
            'periodo'=>periodo::findOrFail($id),
         'grupos_guia'=>$grupos,
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
        $anio_lectivo = anio_lectivo::all();
        return view('periodo.edit',[
            'periodo' => $periodo,
            'anio_lectivo'=>$anio_lectivo,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\periodo  $periodo
     * @return \Illuminate\Http\Response
     */
    public function update(SavePeriodoRequest $request, periodo $periodo)
    {
        $periodo->update($request->validated());
        if ($periodo->activo == 0) {
            foreach ($periodo->materias as $materia) {
                $materia->id_estado=3;
                $materia->push();
            }
        }
        if ($periodo->activo == 1) {
            foreach ($periodo->materias as $materia) {
                $materia->id_estado=1;
                $materia->push();
            }
        }
        return redirect()->route('periodo.show',$periodo)->with('status','Actualizaci??n completada exit??samente');
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
        return redirect()->route('admin.gestionAniosPeriodos')->with('status','Se ha realizado la eliminaci??n');
    }
}
