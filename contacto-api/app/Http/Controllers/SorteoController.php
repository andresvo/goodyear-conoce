<?php

namespace App\Http\Controllers;

use App\Exports\SorteoExport;
use App\Models\Sorteo;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SorteoController extends Controller
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
        $validated = $request->validate([
            'nombres' => 'required',
            'apellidos' => 'required',
            'telefono' => 'required',
            'rut' => 'required',
            'email' => 'required|email',
        ]);

        $file = $request->file('boleta');
        $fileName = $file->getClientOriginalName();
        $filePath = $file->store('sorteos/boletas', 'public');

        $sorteo = new Sorteo;
        $sorteo->nombres = $request->input('nombres');
        $sorteo->apellidos = $request->input('apellidos');
        $sorteo->telefono = $request->input('telefono');
        $sorteo->rut = $request->input('rut');
        $sorteo->email = $request->input('email');
        $sorteo->vehiculo = $request->input('vehiculo');
        $sorteo->n_boleta = $request->input('n_boleta');
        $sorteo->serviteca = $request->input('serviteca');
        $sorteo->boleta = $filePath;
        $sorteo->save();

        return $sorteo;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sorteo  $sorteo
     * @return \Illuminate\Http\Response
     */
    public function show(Sorteo $sorteo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sorteo  $sorteo
     * @return \Illuminate\Http\Response
     */
    public function edit(Sorteo $sorteo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sorteo  $sorteo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sorteo $sorteo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sorteo  $sorteo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sorteo $sorteo)
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function export(Request $request)
    {
        $date_start = $request->input('date_start');
        $date_end = $request->input('date_end');
        return Excel::download(new SorteoExport($date_start, $date_end), 'sorteo.xlsx');
    }
}
