<?php

namespace App\Http\Controllers;
use App\Http\Requests\SaveAnioLectivo;
use App\Models\User;
use App\Models\anio_lectivo;
use App\Models\asignacion;
use App\Models\grupo_guia;
use App\Models\materia;
use App\Models\periodo;
use App\Models\rel_grupo_guia_estudiante;
use App\Models\rubro;
use Illuminate\Auth\register;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;


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

    //METODOS PARA GESTION DE GRUPOS Y PERIODOS
    public function showGrupoGuiaMaterias(grupo_guia $grupo_guia)
    {
        return view('materia.show_materias_grupo_guia',compact('grupo_guia'));
    }
    public function gruposEstudiantes(grupo_guia $grupo_guia)
    {
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
            foreach($grupo_guia->materias as $materia){
                $materia->promedio_estudiante()->save($estudiante);
                $this->setNotasTodasAsignaciones($materia,$estudiante);
            } 
            return redirect()->route('admin.gruposEstudiantes',$grupo_guia)->with('status','Estudiante añadido exitósamente');  
        }else{
            return redirect()->route('admin.gruposEstudiantes',$grupo_guia)->with('status','Estudiante ya existe en el grupo');
        }
    }
    public function crearEstudianteGrupoGuia(grupo_guia $grupo_guia){
        return view('grupo_guia.nuevoEstudiante',['estudiante'=>new user,'grupo_guia'=>$grupo_guia]);
    }

    public function sacarEstudianteGrupo_guia(grupo_guia $grupo_guia,user $estudiante)
    {
        $grupo_guia->estudiantes()->detach($estudiante->id);
        foreach($grupo_guia->materias as $materia){
                $materia->promedio_estudiante()->detach($estudiante);
                $this->deleteNotasTodasAsignaciones($materia,$estudiante);
            } 
        return redirect()->route('admin.gruposEstudiantes',$grupo_guia)->with('status','Estudiante eliminado');  
    }

    //METODOS PARA GESTION DE LIBROS DE NOTAS
    public function showLibroNotas(materia $materia){
        $estudiantes =$materia->promedio_estudiante()->orderBy('name')->get();
        $notas= $materia->rubros;
        return view('libro_notas.show',compact('materia'));
        //return $notas;
    }

    public function setNotasTodasAsignaciones(materia $materia, user $estudiante)
    {
         foreach($materia->rubros as $rubro){
             $this->setNotasRubro($rubro,$estudiante);
            //$rubro->asignaciones()->save($estudiante);
        }
    }
    public function deleteNotasTodasAsignaciones(materia $materia, user $estudiante)
    {
         foreach($materia->rubros as $rubro){
             $this->deleteNotasRubro($rubro,$estudiante);
        }
    }
    private function setNotasRubro(rubro $rubro, user $estudiante)
    {
        foreach($rubro->asignaciones as $asignacion){
            $asignacion->nota()->save($estudiante);
        }
    }
    private function deleteNotasRubro(rubro $rubro, user $estudiante)
    {
        foreach($rubro->asignaciones as $asignacion){
            $asignacion->nota()->detach($estudiante);
        }
    }


    //METODOS CRUD DEL CONTROLADOR, DEBE EVALUARSE SI SE HAN USADO SINO BORRARLOS
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

    public function edit(anio_lectivo $anio)
    {
        return view('admin.edit_anio',[
            'anio_lectivo' => $anio,
        ]);
    }

}
