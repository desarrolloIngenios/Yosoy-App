<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProfileEducacion extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'profile_educacion';

    protected $fillable = [
        'profile_id',
        'titulo_educativo_id',
        'nivel_educativo_id',
        'institucion_educativa_id',
        'ciudad_id',
    ];

    public function profile () {
        return $this->belongsTo(Profile::class, 'profile_id');
    }

    public function nivel_educativo() {
        return $this->belongsTo(\App\Models\Base\NivelEducativo::class, 'nivel_educativo_id');
    }

    public function ciudad() {
        return $this->belongsTo(\App\Models\Base\Ciudad::class, 'ciudad_id');
    }

    public function institucion_educativa() {
        return $this->belongsTo(\App\Models\Base\InstitucionEducativa::class, 'institucion_educativa_id');
    }

    public function titulo_educativo() {
        return $this->belongsTo(\App\Models\Base\TituloEducativo::class, 'titulo_educativo_id');
    }
}
