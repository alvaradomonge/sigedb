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
use App\Models\libro_notas;
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
        //$materia->id_libro_notas=$libro_notas->id;
        $user=User::all();
        return view('materia.create',compact('grupo_guia','materia','user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveMateriaRequest $request)
    {
        
        $libro_notas=libro_notas::insertGetId(
            [
                'es_cualitativo' => $request->es_cualitativo,
            ]
        );
       
     //$request->merge(['id_libro_notas'=>$libro_notas]);
        $request2=$request->all();
        $request2['id_libro_notas']=$libro_notas;
        $request2;

      $mat= new materia($request2);

      // $mat->agregarLibro($mat, $libro_notas);

       return  $mat;
       //return redirect()->route('materia.index')->with('status','materia creado exitósamente');
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
        $user=User::all();
        return view('materia.edit',compact('grupo_guia','materia','user'));
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
