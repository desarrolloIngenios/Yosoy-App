<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        //conteo por roles
        $data['lideresas'] = User::whereHas('roles', function ($query) { $query->where('role_id', 3); })->count();
        $data['candidatas'] = User::doesntHave('roles')->count();

        //conteo perfiles
        $data['per_completados'] =  User::with('profile')->whereHas('profile', function($query) {$query->whereNotNull('numero_documento'); })->count();
        $data['per_nocompletados'] =  User::with('profile')->whereHas('profile', function($query) {$query->whereNull('numero_documento'); })->count();

        //usuarios que no tienen perfil
        //$usuariosSinRol = User::doesntHave('roles')->get();

        //conteo grupo social 
        $data['social_no']= Profile::where('grupo_social_id',1)->count();
        $data['social_etnico']= Profile::where('grupo_social_id',2)->count();
        $data['social_afros']= Profile::where('grupo_social_id',3)->count();
        $data['social_venezolanos']= Profile::where('grupo_social_id',4)->count();
        $data['social_otros']= Profile::where('grupo_social_id',6)->count();
        $data['social_fundaciones']= Profile::whereNotIn('grupo_social_id',[1,2,3,4,6])->count();

        //documento
        $data['cedula_ciudadania'] = Profile::whereHas('tipo_documento', function ($query) { $query->where('nombre', 'CC'); })->count();
        $data['cedula_extrajera'] = Profile::whereHas('tipo_documento', function ($query) { $query->where('nombre', 'CE'); })->count();
        $data['tarjeta_identidad'] = Profile::whereHas('tipo_documento', function ($query) { $query->where('nombre', 'TI'); })->count();
        $data['pasaporte'] = Profile::whereHas('tipo_documento', function ($query) { $query->where('nombre', 'PA'); })->count();
        $data['nit'] = Profile::whereHas('tipo_documento', function ($query) { $query->where('nombre', 'NIT'); })->count();
        $data['otro'] = Profile::whereHas('tipo_documento', function ($query) { $query->where('nombre', 'Otro'); })->count();
        $data['tarjeta_extrajera'] = Profile::whereHas('tipo_documento', function ($query) { $query->where('nombre', 'Tarjeta de extranjería'); })->count();

        $data['ultimosCargos'] = [];

        $data['edades'] = User::with('profile')
            ->whereHas('profile', function($query) {
                $query->whereNotNull('numero_documento');
            })
            ->get()
            ->map(function($user) {
                
                $age = Carbon::parse($user->profile->fecha_nacimiento)->age;
                    if ($age >= 18 && $age <= 24) {
                        $user->age_group = '18-24';
                    } elseif ($age >= 25 && $age <= 34) {
                        $user->age_group = '25-34';
                    } elseif ($age >= 35 && $age <= 44) {
                        $user->age_group = '35-44';
                    } elseif ($age >= 45 && $age <= 54) {
                        $user->age_group = '45-54';
                    } elseif ($age >= 55 && $age <= 64) {
                        $user->age_group = '55-64';
                    } else {
                        $user->age_group = '65+';
                    }
                    
                    return $user;
                })
                ->groupBy('age_group')  
                ->map(function($group) {
                    return $group->count();  
        });

        return view('dashboard.index', $data);
    }
}
