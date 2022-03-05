<?php

namespace App\Models\Base;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NivelExperiencia extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'nivel_experiencia';

}
