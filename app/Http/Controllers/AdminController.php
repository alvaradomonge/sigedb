<?php

namespace App\Http\Controllers;
use App\Http\Requests\SaveAnioLectivo;
use App\Http\Requests\saveRubroRequest;
use App\Http\Requests\SaveAsignacionRequest;
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
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;


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
//-----------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------//
    //METODOS PARA GESTION DE GRUPOS Y PERIODOS FUNCIONES CORE
//-----------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------//
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
//-----------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------//
    //METODOS PARA GESTION DE LIBROS DE NOTAS
//-----------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------//
    public function showLibroNotas(materia $materia){
        $estudiantes =$materia->promedio_estudiante()->orderBy('name')->get();
        $ordenAsignaciones=$materia->asignaciones()->get(['asignacion.id']);
        $ordenAsignaciones=$ordenAsignaciones->pluck('id')->toArray();
        $notas= $materia->estud_asignaciones()->orderBy('id_rubro')->get(['id_estud','id_asig','nota']);
        return view('libro_notas.show',compact('materia','notas','ordenAsignaciones'));

    }

    public function showRubros(materia $materia){
        $porcentaje_total=$this->getPorcentajeTotalRubros($materia);
        return view('libro_notas.show_rubros',compact('materia','porcentaje_total'));
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
    public function nuevoRubro(saveRubroRequest $request,materia $materia){
        rubro::create($request->validated());
        $porcentaje_total=$this->getPorcentajeTotalRubros($materia);
        return redirect()->route('materia.rubros',['materia'=>$materia,'porcentaje_total'=>$porcentaje_total])->with('status','Rubro creado exitósamente');
    }
    public function nuevaAsignacion(saveAsignacionRequest $request,materia $materia){
        $rubro=$materia->rubros()->where('id',$request->id_rubro)->get()->first();
        $asignaciones=$rubro->asignaciones;
        $conteo=0;
        $porcentaje_total=$this->getPorcentajeTotalRubros($materia);
        if ($asignaciones==null) {
        }else{
            foreach($asignaciones as $asignacion){
                $conteo=$conteo+$asignacion->valor_porcentual;
            }
        }
        if ($conteo+$request->valor_porcentual <= $rubro->valor_porcentual) {
           $asignacion=asignacion::create($request->validated());
            foreach($materia->grupo_guia->estudiantes as $estudiante){
                $asignacion->nota()->save($estudiante,['id_materia'=>$materia->id,'id_rubro'=>$rubro->id]);
            }
            return redirect()->route('materia.rubros',['materia'=>$materia,'porcentaje_total'=>$porcentaje_total])->with('status','Asignación creada exitósamente'); 
        }else{
            return redirect()->route('materia.rubros',['materia'=>$materia,'porcentaje_total'=>$porcentaje_total])->with('status','La asignación tiene un valor mayor al total del rubro'); 
        }
        
    }
    public function destroyRubro(rubro $rubro)
    {
        $materia=$rubro->materia;
        $porcentaje_total=$this->getPorcentajeTotalRubros($materia);
        $rubro->delete();
        return redirect()->route('materia.rubros',['materia'=>$materia,'porcentaje_total'=>$porcentaje_total])->with('status','Rubro eliminado exitósamente');
    }

    public function destroyAsignacion(asignacion $asignacion)
    {
        $materia=$asignacion->rubro->materia;
        $porcentaje_total=$this->getPorcentajeTotalRubros($materia);
        $asignacion->delete();
        return redirect()->route('materia.rubros',['materia'=>$materia,'porcentaje_total'=>$porcentaje_total])->with('status','Asignación eliminada exitósamente');
    }
    private function getPorcentajeTotalRubros(materia $materia){
        $porcentaje_total=0;
        foreach($materia->rubros as $rubro){
            $porcentaje_total=$porcentaje_total+$rubro->valor_porcentual;
        }
        return $porcentaje_total;
    }
    private function setNotasRubro(rubro $rubro, user $estudiante)
    {
        foreach($rubro->asignaciones as $asignacion){
            $asignacion->nota()->save($estudiante,['id_materia'=>$rubro->materia->id,'id_rubro'=>$rubro->id]);
        }
    }
    private function deleteNotasRubro(rubro $rubro, user $estudiante)
    {
        foreach($rubro->asignaciones as $asignacion){
            $asignacion->nota()->detach($estudiante);
        }
    }

    public function editAsignacion(asignacion $asignacion, materia $materia)
    {
        return view('libro_notas.editAsignacion',['asignacion'=>$asignacion,'materia'=>$materia]);
    }
    public function updateAsignacion(SaveAsignacionRequest $request, asignacion $asignacion, materia $materia)
    {
        $rubro=$asignacion->rubro;
        $porcentaje_actual=0;
        $valor_porcentual_rubro=$asignacion->rubro->valor_porcentual;
        if ($asignacion->rubro->asignaciones->count()==1) {
            $porcentaje_actual=$asignacion->valor_porcentual;
            //return $porcentaje_actual;
        }else{
            foreach($rubro->asignaciones as $asignacion_){
                $porcentaje_actual=$porcentaje_actual+$asignacion_->valor_porcentual;
            }
            //return $porcentaje_actual;
        }
        $porcentaje_propuesto=$porcentaje_actual-$asignacion->valor_porcentual+$request->valor_porcentual;
        if ($porcentaje_propuesto <= $rubro->valor_porcentual) {
            $porcentaje_total=$this->getPorcentajeTotalRubros($materia);
            $asignacion->update($request->validated());
            return redirect()->route('materia.rubros',['materia'=>$materia,'porcentaje_total'=>$porcentaje_total])->with('status','Asignación actualizada exitósamente');
            //return $porcentaje_propuesto;
        }else{
            $porcentaje_total=$this->getPorcentajeTotalRubros($materia);
            return redirect()->route('materia.rubros',['materia'=>$materia,'porcentaje_total'=>$porcentaje_total])->with('status','El valor porcentual es mayor a la capacidad del rubro');
            //return $porcentaje_propuesto;
        }
        
    }

    public function editCalificacion(materia $materia, asignacion $asignacion)
    {
        return view('libro_notas.calificaAsignacion',['asignacion'=>$asignacion,'materia'=>$materia]);
    }
    public function updatePromedio($id_estud,$id_materia)
    {
        $materia= materia::findOrFail($id_materia);
        $promedio_estudiante= $materia->promedio_estudiante()->where('id_estudiante',$id_estud)->get()->first();
        $nota_asignaciones= $materia->nota_asignaciones()->where('id_estud',$id_estud)->get();
        $promedio_calculado=0;
        foreach ($nota_asignaciones as $asignacion) {
            $promedio_calculado= $promedio_calculado+$asignacion->pivot->nota;
        }
        $promedio_estudiante->pivot->promedio=$promedio_calculado;
        $promedio_estudiante->push();
        return $promedio_calculado;
    }
//-----------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------//
    //MÉTODOS PARA CALIFICAR ASIGNACIONES USANDO AJAX
//-----------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------//
    function fetch_data(Request $request,materia $materia, asignacion $asignacion){
        if ($request->ajax()) {
            $data = $asignacion->nota()->get(['id_estud','id_asig','name','apellido1','apellido2','nota']);
            echo json_encode($data);
        }
    } 

    function update_data(Request $request)
    {
        if($request->ajax())
        {
            
            if ($request->column_name==$request->column_value) {
                $data = array(
                $request->column_name=>$request->column_name
                );
            }elseif ($request->column_value <= $request->valor_porcentual) {
                $data = array(
                $request->column_name=>$request->column_value
                );

                $query= DB::table('nota_estudiante_asignacion')->where('id_asig', $request->id_asig)->where('id_estud', $request->id_estud)->update(['nota'=>$request->column_value]);
                if ($query == NULL) {
                    echo '<div class="alert alert-warning">Actualización no aplicada col value:',$request->column_value,'/col name:',$request->column_name,'</div>';
                }else{
                    $promedio=$this->updatePromedio($request->id_estud,$request->id_materia);
                    echo '<div class="alert alert-success">Nota de estudiante ',$request->estudiante_name,' actualizada. Promedio General: ',$promedio,'% </div>';
                    //
                }
            }else
            {
                echo '<div class="alert alert-danger">La nota de "',$request->estudiante_name,'" es mayor al valor de la asignación (',$request->valor_porcentual,'%), debe corregir esto</div>';
            }
        }
    }
    public function editCalificacionAjax(materia $materia, asignacion $asignacion)
    {
        return view('libro_notas.calificaAsignacion2',['asignacion'=>$asignacion,'materia'=>$materia]);
    }
//-----------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------//
                                //METODOS PARA USUARIO DOCENTE//
//-----------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------//



//-----------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------//
    //METODOS CRUD DEL CONTROLADOR, DEBE EVALUARSE SI SE HAN USADO SINO BORRARLOS//
//-----------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------//
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
//-----------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------//