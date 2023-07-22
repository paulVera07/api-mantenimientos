<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehimantenimiento extends Model
{
    use HasFactory;

    protected $fillable = ['fecha_registro','estado','vehiculo_id','mantenimiento_id'];
}
