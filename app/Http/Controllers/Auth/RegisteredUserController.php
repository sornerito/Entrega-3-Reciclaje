<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        Log::info('REGISTRO: llegó al store', $request->only('name','email'));

        // 👇 Mensajes y nombres de atributos en español
        $messages = [
            'name.required'      => 'El nombre es obligatorio.',
            'name.string'        => 'El nombre no es válido.',
            'name.max'           => 'El nombre no puede superar :max caracteres.',

            'email.required'     => 'El correo es obligatorio.',
            'email.string'       => 'El correo no es válido.',
            'email.email'        => 'El correo no tiene un formato válido.',
            'email.max'          => 'El correo no puede superar :max caracteres.',
            'email.unique'       => 'El correo ya está registrado.',

            'password.required'  => 'La contraseña es obligatoria.',
            'password.confirmed' => 'La confirmación de la contraseña no coincide.',
            'password.min'       => 'La contraseña debe tener al menos :min caracteres.',
        ];

        $attributes = [
            'name'     => 'nombre',
            'email'    => 'correo',
            'password' => 'contraseña',
        ];

        try {
            // Si quieres 8+ caracteres, deja Password::min(8)
            $validated = $request->validate([
                'name'     => ['required', 'string', 'max:255'],
                'email'    => ['required', 'string', 'email', 'max:255', Rule::unique(User::class, 'correo')],
                // 👉 más permisivo para pruebas: mínimo 6
                'password' => ['required', 'confirmed', 'string', 'min:6'],
                // Alternativa más estricta:
                // 'password' => ['required', 'confirmed', Password::min(8)],
            ], $messages, $attributes);
        } catch (ValidationException $e) {
            Log::error('REGISTRO: validación falló', ['errors' => $e->errors()]);
            throw $e;
        }

        Log::info('REGISTRO: validación OK', $validated);

        try {
            $user = User::create([
                'nombre'   => $validated['name'],
                'correo'   => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);

            Log::info('REGISTRO: usuario creado', ['id' => $user->id, 'correo' => $user->correo]);

            return redirect()->route('login')->with('success', 'Usuario registrado con éxito. Ahora inicia sesión.');
        } catch (\Throwable $e) {
            Log::error('REGISTRO: fallo al crear', ['error' => $e->getMessage()]);
            return back()
                ->withErrors(['general' => 'No se pudo registrar. Revisa los datos o intenta más tarde.'])
                ->withInput();
        }
    }
}
