<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

// session_start();
class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    /**
     * Handle the login request.
     */
    public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        $user = Auth::user();

        // Store user data in Laravel session
        session(['user_data' => $user]);  // ✅ Correct way
        // Session::put('user_data', [
        //     'id' => $user->id,
        //     'name' => $user->name,
        //     'email' => $user->email,
        // ]);

        // dd(Session::get('user_data'));
        // session([
        //     'user_data' => [
        //         'id' => $user->id,
        //         'name' => $user->name,
        //         'email' => $user->email,
        //     ]
        // ]);
        // Store permissions
        $permissions = $user->hasPermission();
        Session::put('user_permissions', $permissions);
        // dd(session('user_data'));
        // dd(session('user_data'));
        return redirect()->intended('/admin/dashboard');
    }

    // Redirect back with an error message
    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ]);
}

    /**
     * Logout the user.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
