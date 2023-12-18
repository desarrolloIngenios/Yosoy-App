<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use App\Models\Profile;
use App\Models\Role;
use App\Models\Empresa;
use App\Models\StarRating;
use Illuminate\Contracts\Auth\CanResetPassword;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_role', 'user_id', 'role_id');
    }

    public function offers()
    {
        return $this->belongsToMany(Offer::class, 'offer_user', 'user_id', 'offer_id');
    }

    public function contratos()
    {
        return $this->belongsToMany(Offer::class, 'profile_contrato', 'user_id', 'offer_id')
        ->withPivot(['tipo_contrato_id', 'fecha_contrato'])
        ->withTimestamps();
    }

    public static function getStarRating($user_id)
    {
        $rating = StarRating::where('user_id', $user_id)->avg('rating');
        $rating = ($rating + 5.0) / 2;
        return $rating;
    }

    public function setRoleEmpresario()
    {
        $role = Role::where('name', 'like', 'EMPRESARIO')->first();
        if(!is_null($role)){
            $this->roles()->save($role);
        }
    }

    public function empresa()
    {
        return $this->hasOne(Empresa::class);
    }
}
