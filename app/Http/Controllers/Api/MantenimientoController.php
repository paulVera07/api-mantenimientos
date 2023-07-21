<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\MantenimientoResource;
use App\Models\Mantenimiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MantenimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result = Mantenimiento::where('estado','1') -> get();
        return MantenimientoResource::collection($result);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'denominacion'=>'required',
            'estado'=>'required'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }

        $mantenimiento = Mantenimiento::create($request->all());
        return new MantenimientoResource($mantenimiento);
    }

    /**
     * Display the specified resource.
     */
    public function show(Mantenimiento $mantenimiento)
    {
        return new MantenimientoResource($mantenimiento);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mantenimiento $mantenimiento)
    {
        $validator = Validator::make($request->all(),[
            'denominacion'=>'required',
            'estado'=>'required'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }
        
        $mantenimiento->update($request->all());
        return new MantenimientoResource($mantenimiento);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mantenimiento $mantenimiento)
    {
        if($mantenimiento) $mantenimiento->update(['estado' => 0]);

        return response()->noContent();
    }
}
