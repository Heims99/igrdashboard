<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->intended('/admin');
        }
        return view('auth.login');
    }

    /**
     * Handle authentication attempt.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'state' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();
            
            // Update lastLogin and increment totalLogin
            DB::table('users')->where('user_id', $user->user_id)->update([
                'lastLogin' => now(),
                'totalLogin' => DB::raw('totalLogin + 1'),
            ]);

            // Insert login log into user_log
            DB::table('user_log')->insert([
                'username' => $user->state,
                'loginDate' => now(),
                'ip' => $request->ip(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return redirect()->intended('/admin');
        }

        return back()->withErrors([
            'state' => 'The provided credentials do not match our records.',
        ])->onlyInput('state');
    }

    /**
     * Log the user out.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
