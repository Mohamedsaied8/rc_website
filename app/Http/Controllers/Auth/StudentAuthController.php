<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class StudentAuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('web')->attempt($credentials)) {
            $request->session()->regenerate();
            
            // Redirect to intended URL (like /enroll) or home
            return redirect()->intended(route('home'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:20'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        Auth::guard('web')->login($user);

        return redirect()->intended(route('home'));
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        $response = redirect('/');

        // Best-effort server-side clear of the shared Supabase cookie so the
        // sign-out propagates to the other apps even if JS signOut didn't run.
        // (The logout button also calls supabase.auth.signOut() client-side,
        // which is what broadcasts SIGNED_OUT to other open tabs.)
        $ref = config('supabase.project_ref');
        if ($ref) {
            $names = ["sb-{$ref}-auth-token"];
            for ($i = 0; $i < 6; $i++) {
                $names[] = "sb-{$ref}-auth-token.{$i}";
            }
            foreach ($names as $name) {
                $response->headers->setCookie(cookie()->forget($name, '/'));
            }
        }

        return $response;
    }
}
