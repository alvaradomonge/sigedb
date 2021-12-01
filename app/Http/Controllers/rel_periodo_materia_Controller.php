<?php

namespace App\Http\Controllers;
use App\Models\periodo;
use App\Models\materia;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class rel_periodo_materia_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     // * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $peri = periodo::find(3);
        $mater = materia::find(2);
       return view('Vista_prueba',compact('peri','mater'));
    }
/*
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*public function create()
    {
        $anio_lectivo = anio_lectivo::all();
        return view('periodo.create',compact('anio_lectivo'))->with('periodo',new periodo);
    }*/

    /**
     * Store a newly created resource in storage.
     *
    /* * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     
    public function store(SavePeriodoRequest $request)
    {
        periodo::create($request->validated());

        return redirect()->route('admin.gestionAniosPeriodos')->with('status','Periodo creado exitósamente');
    }
*/
    /**
     * Display the specified resource.
     *
     // * @param  int  $id
     * @return \Illuminate\Http\Response
     
    public function show($id)
    {
        return view('Estudiante.show',[
            'estudiante'=>Estudiante::findOrFail($id)
        ]);
    }

    *
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     
    public function edit($id)
    {
        return view('periodo.edit',[
            'periodo' => $periodo,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     
    public function update(Request $request, $id)
    {
        $periodo->update($request->validated());
        return redirect()->route('periodo.show',$periodo)->with('status','Actualización completada exitósamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     
    public function destroy($id)
    {
        $periodo->delete();
        return redirect()->route('admin.gestionAniosPeriodos')->with('status','Se ha realizado la eliminación');
    }*/
}
