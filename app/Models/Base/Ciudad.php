<?php

namespace App\Models\Base;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ciudad extends Model
{
    use HasFactory;
    use SoftDeletes;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ciudad';

    protected $appends = ['pais_departamento_ciudad'];

    public function departamento() {
        return $this->belongsTo(\App\Models\Base\Departamento::class, 'departamento_id');
    }

    public function getPaisDepartamentoCiudadAttribute($value) {
        return $this->departamento->pais->nombre . ' - ' . $this->departamento->nombre . ' - ' . $this->nombre;
    }
}
