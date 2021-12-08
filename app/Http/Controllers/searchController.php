<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class searchController extends Controller
{
    public function estudiantes(Request $request){
        $term = $request->get('term');
        $queries=user::where('name','LIKE','%'.$term.'%')->where('id_rol_usuario','3')->get();
        $data= [];
        foreach($queries as $query){
            $data[]=[
                'label'=>$query->name
            ];
        }
        return $data;
    }
    public function estudiantesData(Request $request){
        $term = $request->get('id_user');
        $queries=user::where('name','LIKE','%'.$term.'%')->get();
        $data= [];
        foreach($queries as $query){
            $data[]=[
                'label'=>$query->name
            ];
        }
        return $queries;
    }
}
