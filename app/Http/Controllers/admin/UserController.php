<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function users(){
        $loginadmin = Auth::id();
        $users = User::orderBy('created_at','DESC')->where('id', '!=', $loginadmin)->paginate(5);
        return view('admin.users.list',compact('users'));
    }

    public function edituser($id){
        $user = User::findOrFail($id);
        return view('admin.users.edit',compact('user'));
    }

    public function updateuser(Request $request, $id)
    {
    $request->validate([
        'name' => 'required',
        'email' => "required|email|unique:users,email,{$id},id",
    ]);

        $user = User::findOrFail($id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->designation = $request->designation;
        $user->mobile = $request->mobile;

        $user->save();

        return redirect()->route('admin.users')->with('success', 'User Details Updated Successfully');
}

    public function deleteuser($id){
        $user = User::find($id);

        $user->delete();

        return redirect()->route('admin.users',['id' => auth()->id()])->with('success', 'User Deleted Successfully');
}

}
