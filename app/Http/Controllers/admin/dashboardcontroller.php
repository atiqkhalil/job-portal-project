<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class dashboardcontroller extends Controller
{
    public function dashboard($id){
        $user = User::find($id);
        return view('admin.dashboard',compact('user'));
    }
}
