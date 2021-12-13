<?php

namespace App\Http\Controllers;

use App\Models\materia;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Http\Requests\SaveMateriaRequest;
use App\Controllers\grupoGuiaController;
use App\Controllers\libroNotasController;
use App\Models\grupo_guia;
use App\Models\User;
use App\Models\categoria_materia;
use App\Models\estado_materia;
class materiaController extends Controller
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
         $materia = materia::latest('nombre')->paginate(15);
        return view('materia',compact('materia'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $grupo_guia = grupo_guia::all();
        $materia=new materia;
        $categorias=categoria_materia::all();
        $user=User::where('id_rol_usuario',2)->get();
        $estado_materia=estado_materia::all();
        return view('materia.create',compact('grupo_guia','materia','user','categorias','estado_materia'));
    }
    public function create_materia_grupo_guia(grupo_guia $grupo_guia)
    {
        $materia=new materia;
        $categorias=categoria_materia::all();
        $user=User::where('id_rol_usuario',2)->get();
        $estado_materia=estado_materia::all();
        return view('materia.create_grupo_guia',compact('grupo_guia','materia','user','categorias','estado_materia'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveMateriaRequest $request)
    {      
      $mat= materia::create(
             $request->validated()
         );
      $mat->save();  
       //return  $mat;
       return redirect()->route('materia.index')->with('status','materia creado exitósamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\materia  $materia
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $materia=materia::findOrFail($id);
     
        // return view('materia.show',compact('materia'));

        return view('materia.show',[
            'materia'=>materia::findOrFail($id)
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\materia  $materia
     * @return \Illuminate\Http\Response
     */
    public function edit(materia $materia)
    {
        $grupo_guia = grupo_guia::all();
        $materia= $materia;
        $user=User::where('id_rol_usuario',2)->get();
        $categorias=categoria_materia::all();
        $estado_materia=estado_materia::all();
        return view('materia.edit',compact('grupo_guia','materia','user','categorias','estado_materia'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\materia  $materia
     * @return \Illuminate\Http\Response
     */
    public function update(SaveMateriaRequest $request, materia $materia)
    {
        $materia->update($request->validated());
        return redirect()->route('materia.show',$materia)->with('status','Actualización completada exitósamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\materia  $materia
     * @return \Illuminate\Http\Response
     */
    public function destroy(materia $materia)
    {
         $materia->delete();
        return redirect()->route('materia.index')->with('status','Se ha realizado la eliminación');
    }

    
}
