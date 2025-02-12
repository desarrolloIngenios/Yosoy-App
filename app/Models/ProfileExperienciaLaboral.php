<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProfileExperienciaLaboral extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'profile_experiencia_laboral';

    protected $fillable = [
        'profile_id',
        'cargo_id',
        'empleador_id',
        'sector_id',
        'pais_id',
        'ciudad_id',
        'fecha_inicio',
        'fecha_fin',
        'is_actual',
        'empleador',
        'contrato_id'
    ];

    public function profile () {
        return $this->belongsTo(Profile::class, 'profile_id');
    }

    public function cargo() {
        return $this->belongsTo(\App\Models\Base\Cargo::class, 'cargo_id');
    }

    public function sector() {
        return $this->belongsTo(\App\Models\Base\Sector::class, 'sector_id');
    }

    public function pais() {
        return $this->belongsTo(\App\Models\Base\Pais::class, 'pais_id');
    }

    public function ciudad() {
        return $this->belongsTo(\App\Models\Base\Ciudad::class, 'ciudad_id');
    }
    public function contrato() {
        return $this->belongsTo(\App\Models\Base\TipoContrato::class, 'contrato_id');
    }

    /*public function empleador() {
        return $this->belongsTo(\App\Models\Base\Empleador::class, 'empleador_id');
    }*/

}
