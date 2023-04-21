<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZenSmartFacturaElectronica extends Model
{
    use HasFactory;

    protected $table = 'zensmart_factura_electronica';

    protected $fillable = [
                            'empresa_id',
                            'wompi_transacion_id',
                            'object',
                            'is_factura_enviada_correctamente',
                        ];

}