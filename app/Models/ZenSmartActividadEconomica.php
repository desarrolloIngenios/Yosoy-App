<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZenSmartActividadEconomica extends Model
{
    use HasFactory;

    protected $table = 'zensmart_regime';

    protected $fillable = [
                            'descripcion',
                            'nombre',
                            'codigo',
                        ];

}
