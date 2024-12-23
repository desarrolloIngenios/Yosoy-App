<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function create()
    {  
        $role = Role::where('name','LIDERESA')->first();
        if($role){
            return redirect()->route('login');
        }else{
            Role::create([
                'name' => 'LIDERESA',
            ]);
        }
        return redirect()->route('login');
    }
}
