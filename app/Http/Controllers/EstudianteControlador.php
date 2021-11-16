<?php

namespace App\Http\Controllers;
use App\Http\Requests\SaveEstudianteRequest;
use App\Models\Estudiante;
use Illuminate\Http\Request;
class EstudianteControlador extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){

        $this->middleware('auth')->except('index','show');
    }
    public function index()
    {
        $estudiante = Estudiante::latest('created_at')->paginate(15);
        return view('estudiante',compact('estudiante'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('estudiante.create',['estudiante' => new Estudiante]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveEstudianteRequest $request )
    {
        
        // $nombre= request('nombre');
        // $apellido1= request('apellido1');
        // $apellido2= request('apellido2');
        // $email= request('email');
        // $cedula= request('cedula');
        // $tel= request('tel');
        // $estado= request('estado');
        // $direccion= request('direccion');

        Estudiante::create($request->validated());

        return redirect()->route('estudiante.index')->with('status','Estudiante creado exitósamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Estudiante $estudiante)
    {
        return view('estudiante.edit',[
            'estudiante' => $estudiante,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Estudiante $estudiante, SaveEstudianteRequest $request)
    {
        $estudiante->update($request->validated());
        return redirect()->route('estudiante.show',$estudiante)->with('status','Actualización completada exitósamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Estudiante $estudiante)
    {
        $estudiante->delete();
        return redirect()->route('estudiante.index')->with('status','Se ha realizado la eliminación');
    }
}
