<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'codes';

    protected $fillable = [
        'code',
        'used_date',
    ];

    static public function is_used($code) {
        $code = self::where('code', $code)->first();
        if(!is_null($code) && is_null($code->used_date)){
            return false;
        }
        return true;
    }

    static public function set_used($code) {
        $code = self::where('code', $code)->first();
        if(!is_null($code) && is_null($code->used_date)){
            $code->used_date = \Carbon\Carbon::now();
            $code->save();
        }
    }

    static public function generate($count) {
        for ($i=0; $i < $count; $i++) { 
            $generate_code = rand(10000,99999);
            $code = new Code();
            $code->code = $generate_code;
            $code->save();
        }
    }

}
