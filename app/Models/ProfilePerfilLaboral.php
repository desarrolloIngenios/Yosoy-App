<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProfilePerfilLaboral extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'profile_perfil_laboral';

    protected $fillable = [
        'profile_id',
        'cargo_id',
        'nivel_experiencia_id',
        'tiempo_experiencia_id',
    ];

    public function profile () {
        return $this->belongsTo(Profile::class, 'profile_id');
    }

    public function cargo() {
        return $this->belongsTo(\App\Models\Base\Cargo::class, 'cargo_id');
    }

    public function nivel_experiencia() {
        return $this->belongsTo(\App\Models\Base\NivelExperiencia::class, 'nivel_experiencia_id');
    }

    public function tiempo_experiencia() {
        return $this->belongsTo(\App\Models\Base\TiempoExperiencia::class, 'tiempo_experiencia_id');
    }

}
