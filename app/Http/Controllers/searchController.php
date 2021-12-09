<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\grupo_guia;
use Illuminate\Http\Request;

class searchController extends Controller
{
    public function estudiantes(Request $request){
        $term = $request->get('term');
        $queries=user::where('name','LIKE','%'.$term.'%')->where('id_rol_usuario','3')->get();
        $data= [];
        foreach($queries as $query){
            $data[]=[
                'label'=>$query->getFullName(),
            ];
        }
        return $data;
    }
    public function estudiantesData(Request $request,grupo_guia $grupo_guia){
        $term = $request->get('id_user');
        $id=strtok($request->get('id_user'), " ");
        $queries=user::where('id',$id)->where('id_rol_usuario','3')->get();
        $data= [];
        foreach($queries as $query){
            $data[]=[
                'label'=>$query->getFullName(),
            ];
        }
        return $queries;
    }
}
