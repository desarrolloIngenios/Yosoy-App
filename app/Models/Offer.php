<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Offer extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'offer';

    protected $fillable = [
                            'description',
                            'cargo_id',
                            'sector_id',
                            'ciudad_id',
                            'nivel_educativo_id',
                            'tiempo_experiencia_id',
                            'company_id',
                        ];
    
    protected $appends = ['total_aplicaciones'];

    public function getTotalAplicacionesAttribute()
    {
        return $this->users()->count();
    }


    public function cargo() {
        return $this->belongsTo(\App\Models\Base\Cargo::class, 'cargo_id');
    }

    public function sector() {
        return $this->belongsTo(\App\Models\Base\Sector::class, 'sector_id');
    }

    public function ciudad() {
        return $this->belongsTo(\App\Models\Base\Ciudad::class, 'ciudad_id');
    }

    public function nivel_educativo() {
        return $this->belongsTo(\App\Models\Base\NivelEducativo::class, 'nivel_educativo_id');
    }

    public function tiempo_experiencia() {
        return $this->belongsTo(\App\Models\Base\TiempoExperiencia::class, 'tiempo_experiencia_id');
    }

    public function tipo_contrato()
    {
        return $this->belongsToMany(\App\Models\Base\TipoContrato::class, 'offer_tipo_contrato', 'offer_id', 'tipo_contrato_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'offer_user', 'offer_id', 'user_id')
                ->with('profile.ciudad_residencia',
                      'profile.genero',
                      'profile.tipo_documento',
                      'profile.genero',
                      'profile.perfiles_laborales.nivel_experiencia',
                      'profile.perfiles_laborales.cargo',
                    
                    );
    }
    

    

}
