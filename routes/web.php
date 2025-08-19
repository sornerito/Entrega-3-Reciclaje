<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

Route::get('/', fn () => redirect()->route('login'));

Route::get('/dashboard', fn () => view('dashboard'))
    ->middleware(['auth'])
    ->name('dashboard');

require __DIR__.'/auth.php';

// === Debug solo en local ===
if (app()->environment('local')) {
    Route::get('/dev/checkpass/{correo}/{plain}', function ($correo, $plain) {
        $u = User::where('correo', $correo)->first();
        if (! $u) return "No existe usuario con correo: {$correo}";
        $ok = Hash::check($plain, $u->password);
        return "Hash prefix: " . substr($u->password, 0, 4) .
               " | len: " . strlen($u->password) .
               " | check=" . ($ok ? 'true' : 'false');
    });

    Route::get('/dev/setpass-and-login/{correo}/{plain}', function ($correo, $plain) {
        $u = User::where('correo', $correo)->first();
        if (! $u) return "No existe usuario con correo: {$correo}";

        $u->password = Hash::make($plain);
        $u->save();

        if (! Hash::check($plain, $u->password)) {
            return "ERROR: Hash::check() sigue dando false. prefix=" .
                   substr($u->password, 0, 4) . " len=" . strlen($u->password);
        }

        Auth::login($u, true);
        request()->session()->regenerate();

        return redirect()->route('dashboard');
    });
}
