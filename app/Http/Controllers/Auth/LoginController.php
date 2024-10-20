<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Socialite;
use App\Models\User;
use App\Models\UserModel;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite as FacadesSocialite;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login()
    {
        // Validar los datos del formulario
        // Lógica para iniciar sesión
    }

    public function redirectToGoogle()
    {
        return FacadesSocialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $user = FacadesSocialite::driver('google')->user();
        // Lógica para registrar o iniciar sesión al usuario
    }

    public function redirectToFacebook()
    {
        return FacadesSocialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        $user = FacadesSocialite::driver('facebook')->user();
        Log::info("USER FROM FACEBOOK");
        Log::info(json_encode($user, JSON_PRETTY_PRINT));
        // UserModel::create([
        //     'name' => $user->getName(),
        //     'email' => $user->getEmail(),
        //     'role' => 'STUDENT'
        // ]);

        $userLogged = UserModel::firstOrCreate([
            'email' => $user->getEmail()
        ], [
            'name' => $user->getName(),
            'role' => 'STUDENT',
        ]);
        auth()->login($userLogged);
        return redirect()->to('/dashboard');
    }
}
