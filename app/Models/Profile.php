<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $table = 'profile';

    protected $fillable = [
        'name',
        'last_name',
        'user_id',
        'tipo_documento_id',
        'numero_documento',
        'genero_id',
        'email',
        'ciudad_residencia_id',
        'direccion_residencia',
        'numero_contacto_1',
        'numero_contacto_2',
        'fecha_nacimiento',
        'pais_residencia_id',
        'is_empirico',
        'foto_perfil_url',
        'code',
        'grupo_social_id',
        'bancarizacion_id',
        'banco',
        'billetera',
        'eps',
        'nombre_eps',
        'numero_hijos',
        'currently_works'
    ];

    protected $appends = ['full_name', 'grupo_social_nombre'];

    public function getFullNameAttribute($value)
    {
        return $this->name . ' ' . $this->last_name;
    }
    public function getGrupoSocialNombreAttribute($value)
    {

        $array_grupo_social = [];
        $array_grupo_social[1] = '-';
        $array_grupo_social[2] = "Grupos étnicos";
        $array_grupo_social[3] = "Afros";
        $array_grupo_social[4] = "Venezolanos";
        $array_grupo_social[5] = "Fundación Acción Interna";
        $array_grupo_social[7] = "Fundación afro, indígenas y mestizos";
        $array_grupo_social[8] = "Fundación GAAT";
        $array_grupo_social[9] = "Fundación Soy Oportunidad";
        $array_grupo_social[10] = "Mujeres Endógenas del Cauca";
        $array_grupo_social[11] = "Fundación Compromiso Valle";
        $array_grupo_social[12] = "Fundación Apoyar";
        $array_grupo_social[13] = "Fundación para la reconciliación";
        $array_grupo_social[14] = "Fundación CIREC";
        $array_grupo_social[15] = "Fundación levántate y anda";
        $array_grupo_social[16] = "Fundación Fé";
        $array_grupo_social[17] = "Tiempo de Juego";
        $array_grupo_social[18] = "Fundación Creando Futuro";
        $array_grupo_social[19] = "Fundación Huellas";
        $array_grupo_social[20] = "Fundación Laudes Infantis";
        $array_grupo_social[21] = "Fundación poder joven";
        $array_grupo_social[22] = "Centro Mya";
        $array_grupo_social[23] = "Fundación AR";
        $array_grupo_social[6] = "Otros";

        if (isset($array_grupo_social[$this->grupo_social_id])) {
            return $array_grupo_social[$this->grupo_social_id];
        } else {
            return "";
        }
    }


    public function educaciones()
    {
        return $this->hasMany(ProfileEducacion::class, 'profile_id');
    }

    public function ciudad_residencia()
    {
        return $this->belongsTo(\App\Models\Base\Ciudad::class, 'ciudad_residencia_id');
    }

    public function genero()
    {
        return $this->belongsTo(\App\Models\Base\Genero::class, 'genero_id');
    }

    public function tipo_documento()
    {
        return $this->belongsTo(\App\Models\Base\TipoDocumento::class, 'tipo_documento_id');
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    public function bancarizacion()
    {
        return $this->belongsTo(\App\Models\Base\Bancarizacion::class, 'bancarizacion_id');
    }

    public function is_complete_form()
    {
        if (
            !is_null($this->tipo_documento_id) &&
            !is_null($this->numero_documento) &&
            !is_null($this->name) &&
            !is_null($this->last_name) &&
            !is_null($this->genero_id) &&
            !is_null($this->fecha_nacimiento) &&
            !is_null($this->email) &&
            !is_null($this->numero_contacto_1) &&
            !is_null($this->numero_contacto_2) &&
            !is_null($this->ciudad_residencia_id) &&
            !is_null($this->direccion_residencia) &&
            !is_null($this->bancarizacion_id)
        ) {
            return true;
        }
        return false;
    }
}
