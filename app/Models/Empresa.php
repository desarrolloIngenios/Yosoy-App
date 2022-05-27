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
                        ];
    
   
    public function ciudad() {
        return $this->belongsTo(\App\Models\Base\Ciudad::class, 'ciudad_id');
    }

}
