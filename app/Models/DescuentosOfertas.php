<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DescuentosOfertas extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'descuentos_ofertas';

    protected $fillable = [
                            'numero_ofertas',
                            'porcentaje_descuento'
                        ];
    
}
