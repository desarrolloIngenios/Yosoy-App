<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    protected $table = 'company';

    protected $fillable = [
                            'nombre',
                            'nit',
                            'direccion',
                            'descripcion',
                            'numero_contacto',
                            'ciudad_id',
                            'email_factura_electronica',
                            'digito_verificacion',
                            'tipo_documento_id',
                            'regimen_id',
                            'actividad_economica_id',
                            'codigo_postal',

                        ];

   
    public function ciudad() {
        return $this->belongsTo(\App\Models\Base\Ciudad::class, 'ciudad_id');
    }

    public function regimen() {
        return $this->belongsTo(\App\Models\ZenSmartRegimen::class, 'regimen_id');
    }

    public function actividad_economica() {
        return $this->belongsTo(\App\Models\ZenSmartActividadEconomica::class, 'actividad_economica_id');
    }

    public function tipo_documento() {
        return $this->belongsTo(\App\Models\Base\TipoDocumento::class, 'tipo_documento_id');
    }

}
