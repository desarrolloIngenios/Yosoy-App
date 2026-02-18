<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use App\Models\Profile;
use App\Models\Role;
use Illuminate\Contracts\Auth\CanResetPassword;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'id_lideresa'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

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


    public function setRoleEmpresario()
    {
        $role = Role::where('name', 'like', 'EMPRESARIO')->first();
        if (!is_null($role)) {
            $this->roles()->save($role);
        }
    }

    public function setRoleLidereza()
    {
        $role = Role::where('name', 'like', 'LIDERESA')->first();
        if (!is_null($role)) {
            $this->roles()->save($role);
        }
    }


    /**
     * Comentarios recibidos por este usuario (como mentee).
     */
    public function menteeComments()
    {
        return $this->hasMany(\App\Models\MenteeComment::class, 'mentee_id');
    }

    /**
     * Comentarios escritos por este usuario.
     */
    public function authoredComments()
    {
        return $this->hasMany(\App\Models\MenteeComment::class, 'author_id');
    }
}
