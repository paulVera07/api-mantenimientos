<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\VehimantenimientoResource;
use App\Models\Vehimantenimiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VehimantenimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result = Vehimantenimiento::where('estado',1) -> get();
        return VehimantenimientoResource::collection($result);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'fecha_registro'=>'required',
            'estado'=>'required',
            'vehiculo_id'=>'required',
            'mantenimiento_id'=>'required'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }

        $vehimantenimiento = Vehimantenimiento::create($request->all());
        return new VehimantenimientoResource($vehimantenimiento);

    }

    /**
     * Display the specified resource.
     */
    public function show(Vehimantenimiento $vehimantenimiento)
    {
        return new VehimantenimientoResource($vehimantenimiento);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vehimantenimiento $vehimantenimiento)
    {
        $validator = Validator::make($request->all(),[
            'fecha_registro'=>'required',
            'estado'=>'required',
            'vehiculo_id'=>'required',
            'mantenimiento_id'=>'required'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }
        
        $vehimantenimiento->update($request->all());
        return new VehimantenimientoResource($vehimantenimiento);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehimantenimiento $vehimantenimiento)
    {
        if($vehimantenimiento) $vehimantenimiento->update(['estado' => 0]);
        return response()->noContent();

    }
}
