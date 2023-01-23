<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZenSmartTipoMoneda extends Model
{
    use HasFactory;

    protected $table = 'zensmart_tipo_moneda';

    protected $fillable = [
                            'descripcion',
                            'nombre',
                            'codigo',
                        ];

}
