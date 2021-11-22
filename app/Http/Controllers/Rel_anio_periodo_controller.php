<?php

namespace App\Http\Controllers;

use App\Models\periodo;
use App\Models\rel_anio_periodo;
use Illuminate\Http\Request;

class Rel_anio_periodo_controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        rel_anio_periodo::create($request->validated());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\rel_anio_periodo  $rel_anio_periodo
     * @return \Illuminate\Http\Response
     */
    public function show(rel_anio_periodo $rel_anio_periodo)
    {
        //
    }

    public function show(anio_lectivo $anio)
    {
        $periodo = periodo::latest('created_at')->paginate(15);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\rel_anio_periodo  $rel_anio_periodo
     * @return \Illuminate\Http\Response
     */
    public function edit(rel_anio_periodo $rel_anio_periodo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\rel_anio_periodo  $rel_anio_periodo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, rel_anio_periodo $rel_anio_periodo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\rel_anio_periodo  $rel_anio_periodo
     * @return \Illuminate\Http\Response
     */
    public function destroy(rel_anio_periodo $rel_anio_periodo)
    {
        //
    }
}
