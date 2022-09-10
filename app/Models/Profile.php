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
                        ];
    
    protected $appends = ['full_name'];

    public function getFullNameAttribute($value) {
        return $this->name . ' ' . $this->last_name;
    }

    public function perfiles_laborales()
    {
        return $this->hasMany(ProfilePerfilLaboral::class, 'profile_id');
    }

    public function experiencias_laborales()
    {
        return $this->hasMany(ProfileExperienciaLaboral::class, 'profile_id');
    }

    public function educaciones()
    {
        return $this->hasMany(ProfileEducacion::class, 'profile_id');
    }

    public function ciudad_residencia() {
        return $this->belongsTo(\App\Models\Base\Ciudad::class, 'ciudad_residencia_id');
    }

    public function genero() {
        return $this->belongsTo(\App\Models\Base\Genero::class, 'genero_id');
    }

    public function tipo_documento() {
        return $this->belongsTo(\App\Models\Base\TipoDocumento::class, 'tipo_documento_id');
    }

    public function user() {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
    

    

}
