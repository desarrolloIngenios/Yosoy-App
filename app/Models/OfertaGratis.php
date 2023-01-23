<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OfertaGratis extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'ofertas_gratis';

    protected $fillable = [
                            'user_id',
                            'cantidad_ofertas'
                        ];
    
    public function user() {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

}
