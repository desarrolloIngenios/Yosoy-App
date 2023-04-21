<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZenSmartActividadEconomica extends Model
{
    use HasFactory;

    protected $table = 'zensmart_actividad_economica';

    protected $fillable = [
                            'descripcion',
                            'nombre',
                            'codigo',
                        ];

}
