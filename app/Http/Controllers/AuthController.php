<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Mostrar formulario de registro
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Procesar registro
    public function register(Request $request)
    {
        $request->validate([
            'nombre'          => 'required|string|max:255',
            'numeroidentidad' => 'required|string|max:50|unique:usuarios,numeroidentidad',
            'localidad'       => 'required|string|max:100',
            'direccion'       => 'required|string|max:200',
            'correo'          => 'required|string|email|max:255|unique:usuarios,correo',
            'numerocelular'   => 'required|string|max:20',
            'password'        => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'nombre'           => $request->nombre,
            'numeroidentidad'  => $request->numeroidentidad,
            'localidad'        => $request->localidad,
            'direccion'        => $request->direccion,
            'correo'           => $request->correo,
            'numerocelular'    => $request->numerocelular,
            'password'         => Hash::make($request->password),
            'rol'              => 'usuario',
            'estadosuscripcion'=> true,
            'fecharegistro'    => now(),
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('dashboard');
    }

    // Mostrar formulario de login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Procesar login (usando 'correo' en lugar de 'email')
    public function login(Request $request)
    {
        $request->validate([
            'correo'   => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt(['correo' => $request->correo, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'));
        }

        return back()->withErrors([
            'correo' => 'Las credenciales no coinciden.',
        ])->onlyInput('correo');
    }

    // Cerrar sesión
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.form');
    }
}
