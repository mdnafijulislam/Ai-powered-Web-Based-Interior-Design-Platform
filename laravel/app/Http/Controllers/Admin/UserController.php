<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller {
    public function index(Request $request){
        $users = User::latest()->paginate(20);
        return view('admin.users.index', compact('users'));
    }

    public function suspend(User $user){
        $user->is_suspended = ! $user->is_suspended;
        $user->save();
        return back()->with('success','User updated');
    }

    public function destroy(User $user){
        $user->delete();
        return back()->with('success','User deleted');
    }
}
