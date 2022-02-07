<?php

namespace App\Http\Controllers;

use App\Departamento;
use App\empleado;
use Illuminate\Http\Request;
use App\Http\Requests\EmpleadoRequest;
use Illuminate\Support\Facades\DB;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        
        
        $empleados = empleado::all();
        $departments = Departamento::all();

        return view('empleado.index', compact('empleados','departments'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmpleadoRequest $request)
    {
        $empleado = empleado::create($request->all());

        $empleado->save();

        return redirect('/home')->with('status', 'Empleado Creado con exito');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmpleadoRequest $request, $id)
    {
        $empleado = empleado::find($request->id);

        $empleado->update($request->all());
        $empleado->save();
        return redirect('/home')->with('status', 'Empleado Editado con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $empleado = empleado::find($id);
        $empleado->delete();
        return redirect('/home')->with('status', 'Empleado Eliminado con exito');
    }

    public function search(Request $request)
    {
        
        $nombre             = $request->input('nombre') == '' ? '' :$request->input('nombre');
        $correo             = $request->input('correo') == '' ? '' :$request->input('correo');;
        $telefono           = $request->input('telefono') == '' ? '' :$request->input('telefono');;
        $departamento_id    = $request->input('departamento_id') == '' ? '' :$request->input('departamento_id');;

        
            $empleados = DB::table('empleados')
            ->select('empleados.id', 'empleados.nombre', 'empleados.correo', 'empleados.telefono','departamentos.nombreDepartamento')
            ->leftJoin('departamentos', 'empleados.departamento_id', '=', 'departamentos.id')
            ->orWhere('nombre', $nombre)
            ->orWhere('correo', '=', $correo)
            ->orWhere('telefono', $telefono)
            ->orWhere('departamento_id', '=', $departamento_id)
            ->get();
    

        return response()->json($empleados, 201);
    }
}
