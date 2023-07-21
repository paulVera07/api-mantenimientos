<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\VehiculoResource;
use App\Models\Vehiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VehiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result = Vehiculo::where('estado',1) -> get();
        return VehiculoResource::collection($result);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'placa'=>'required',
            'marca'=>'required',
            'estado'=>'required'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }

        $mantenimiento = Vehiculo::create($request->all());
        return new VehiculoResource($mantenimiento);

    }

    /**
     * Display the specified resource.
     */
    public function show(Vehiculo $vehiculo)
    {
        return new VehiculoResource($vehiculo);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vehiculo $vehiculo)
    {
        $validator = Validator::make($request->all(),[
            'placa'=>'required',
            'marca'=>'required',
            'estado'=>'required'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }
        
        $vehiculo->update($request->all());
        return new VehiculoResource($vehiculo);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehiculo $vehiculo)
    {
        if($vehiculo) $vehiculo->update(['estado' => 0]);
        return response()->noContent();
    }
}
