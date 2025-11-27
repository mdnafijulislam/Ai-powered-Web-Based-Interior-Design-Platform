<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    // Show Register Page
    public function showRegister() {
        return view('auth.register');
    }

    // Register form submit
    public function register(Request $request) {

        // Basic validation placeholder
        $request->validate([
            'name'     => 'required',
            'email'    => 'required|email',
            'password' => 'required|min:4',
            'role'     => 'required'
        ]);

        // Later we will add database save code here (Step 5)
        
        return back()->with('success', 'Form received (Database yet to add)');
    }

}
