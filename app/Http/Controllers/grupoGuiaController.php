<?php

namespace App\Http\Controllers;
use App\Models\grupo_guia;
use App\Models\periodo;
use App\Http\Controllers\Controller;
use App\Http\Requests\SaveGrupoGuiaRequest;
use Illuminate\Http\Request;

class grupoGuiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 
     */
    public function __construct(){

        $this->middleware('auth')->except('show');
    }

    public function index()
    {
         $grupo_guia = grupo_guia::latest('nombre')->paginate(15);
         return view('grupo_guia.grupo_guia',compact('grupo_guia'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $periodo=periodo::all();
         $grupo_guia=new grupo_guia;
        return view('grupo_guia.create',compact('grupo_guia','periodo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveGrupoGuiaRequest $request)
    {
        grupo_guia::create($request->validated());

        return redirect()->route('grupo_guia.index')->with('status','grupo_guia creado exitósamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       return view('grupo_guia.show',[
            'grupo_guia'=>grupo_guia::findOrFail($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(grupo_guia $grupo_guia)
    {
        $periodo=periodo::all();
         $grupo_guia=$grupo_guia;
        return view('grupo_guia.edit',compact('grupo_guia','periodo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SaveGrupoGuiaRequest $request, grupo_guia $grupo_guia)
    {
         $grupo_guia->update($request->validated());
        return redirect()->route('grupo_guia.index',$grupo_guia)->with('status','Actualización completada exitósamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(grupo_guia $grupo_guia)
    {
        $grupo_guia->delete();
        return redirect()->route('grupo_guia.index')->with('status','Se ha realizado la eliminación');
    }
}
