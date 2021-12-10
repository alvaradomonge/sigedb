<?php

namespace App\Http\Controllers;
use App\Http\Requests\SaveAnioLectivo;
use App\Models\User;
use App\Models\anio_lectivo;
use App\Models\grupo_guia;
use App\Models\periodo;
use App\Models\rel_grupo_guia_estudiante;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct(){

        $this->middleware('auth')->except('show');
    }
    public function index()
    {
        $query=periodo::all()->where('activo','1');
        $anio_lectivo = anio_lectivo::latest('nombre')->paginate(15);
        return view('admin.gestionAniosPeriodos',compact('anio_lectivo','query'));
    }
    public function gruposEstudiantes(grupo_guia $grupo_guia)
    {
        //return $grupo_guia->estudiantes;
        return view('admin.gruposEstudiantes',compact('grupo_guia'));
    }
    public function create()
    {
        return view('admin.create_anio_lectivo',['anio_lectivo' => new anio_lectivo]);
    }
    public function storeGrupoGuiaEstudiante(Request $request, grupo_guia $grupo_guia)
    {
        $estudiante =user::find(strtok($request->get('id_user'), " "));
        $tiene= $grupo_guia->estudiantes->find($estudiante->id);
        if(empty($tiene)){
            $grupo_guia->estudiantes()->save($estudiante);
            return redirect()->route('admin.gruposEstudiantes',$grupo_guia)->with('status','Estudiante añadido exitósamente');  
        }else{
            return redirect()->route('admin.gruposEstudiantes',$grupo_guia)->with('status','Estudiante ya existe en el grupo');
        }
    }
    public function sacarEstudianteGrupo_guia(grupo_guia $grupo_guia,user $estudiante)
    {
        $grupo_guia->estudiantes()->detach($estudiante->id);
        return redirect()->route('admin.gruposEstudiantes',$grupo_guia)->with('status','Estudiante eliminado');  
        //return $user;
    }
    public function store(SaveAnioLectivo $request)
    {
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
