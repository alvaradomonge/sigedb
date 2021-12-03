<?php

namespace App\Http\Controllers;
use App\Http\Requests\SaveAnioLectivo;
use App\Models\anio_lectivo;
use Illuminate\Http\Request;

class AnioLectivoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){

        $this->middleware('auth')->except('show');
    }

    public function index()
    {
        $anio_lectivo = anio_lectivo::latest('nombre')->paginate(15);
        return view('admin.gestionAniosPeriodos',compact('anio_lectivo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create_anio_lectivo',['anio_lectivo' => new anio_lectivo]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveAnioLectivo $request)
    {
       anio_lectivo::create($request->validated());

        return redirect()->route('anio_lectivo.index')->with('status','Año creado exitósamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.anioLectivoShow',[
           'anio_lectivo'=>anio_lectivo::findOrFail($id)
        ]);    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(anio_lectivo $anio_lectivo)
    {
        return view('admin.edit_anio',['anio_lectivo' => $anio_lectivo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SaveAnioLectivo $request, anio_lectivo $anio)
    {
        //$anio = anio_lectivo::findOrFail($id);
        $anio->update($request->validated());
        return redirect()->route('admin.anioLectivoShow',$anio)->with('status','Actualización completada exitósamente');
        //return $anio;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $anio = anio_lectivo::findOrFail($id)->delete();
        return redirect()->route('anio_lectivo.index')->with('status','Se ha realizado la eliminación');
        //return anio_lectivo::findOrFail($id);
    }
}
