<?php

namespace App\Http\Controllers;
use App\Http\Requests\SaveAnioLectivo;
use App\Models\anio_lectivo;
use App\Models\periodo;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct(){

        $this->middleware('auth')->except('show');
    }
    public function index()
    {
        $query=periodo::find('1')->relacion;
        $anio_lectivo = anio_lectivo::latest('nombre')->paginate(15);
        return view('admin.gestionAniosPeriodos',compact('anio_lectivo','query'));
    }
    public function indexGestionAniosPeriodos()
    {
        //$query=anio_lectivo::latest('nombre')->where('periodos.');
        $anio_lectivo = anio_lectivo::latest('nombre')->paginate(15);
        return view('admin.gestionAniosPeriodos',compact('anio_lectivo','query'));
    }
    public function create()
    {
        return view('admin.create_anio_lectivo',['anio_lectivo' => new anio_lectivo]);
    }
    public function store(SaveAnioLectivo $request)
    {
        
        // $nombre= request('nombre');
        // $apellido1= request('apellido1');
        // $apellido2= request('apellido2');
        // $email= request('email');
        // $cedula= request('cedula');
        // $tel= request('tel');
        // $estado= request('estado');
        // $direccion= request('direccion');

        anio_lectivo::create($request->validated());

        return redirect()->route('admin.index')->with('status','Año creado exitósamente'); 
    }
    public function show($id)
    {
        return view('admin.anioLectivoShow',[
            'anio_lectivo'=>anio_lectivo::findOrFail($id)
        ]);
    }

    public function update(anio_lectivo $anio, SaveAnioLectivo $request)
    {
        $anio->update($request->validated());
        return redirect()->route('admin.show',$anio)->with('status','Actualización completada exitósamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(anio_lectivo $anio)
    {
        $anio->delete();
        return redirect()->route('admin.index')->with('status','Se ha realizado la eliminación');
    }

    public function edit(anio_lectivo $anio)
    {
        return view('admin.edit_anio',[
            'anio_lectivo' => $anio,
        ]);
    }

}
