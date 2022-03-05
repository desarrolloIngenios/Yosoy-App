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
                        ];

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

    

}
