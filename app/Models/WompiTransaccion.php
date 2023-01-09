<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WompiTransaccion extends Model
{
    use HasFactory;

    protected $table = 'wompi_transacion';

    protected $fillable = [
                            'user_id',
                            'referencia',
                            'transaccion_wompi_id',
                            'estado_wompi',
                            'valor_wompi',
                            'fecha_wompi',
                        ];
   
    public function user() {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

}
