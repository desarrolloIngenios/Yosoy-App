<?php

namespace App\Models\Base;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoContrato extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'tipo_contrato';

}
