<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function googleRedirect(){
        return Socialite::driver('google')->redirect();
    }

    public function loginWithGoogle(){
        try {
            $userSocial = Socialite::driver('google')->user();
            $user = User::where('email', $userSocial->email)->first();
            if(!$user):
                $user = User::create([
                    'name' => $userSocial->name,
                    'email' => $userSocial->email,
                    'google_id' => $userSocial->id,
                    'connected_google' => true
                ]);
                $user->image()->create([
                    'url' => $userSocial->avatar,
                    'name' => $userSocial->avatar,
                ]);
            endif;
            if(!$user->connected_google):
                session()->flash('alert', 'Se deshabilitó el inicio de sesión mediante Google. Contacte a soporte');
                session()->flash('alert-type', 'warning');
                return Redirect::route('login');
            else:
                Auth::login($user);
                if($user->roles()->count()):
                    return Redirect::route('admin.dashboard.general.index');
                else:
                    return Redirect::route('web.home.index');
                endif;
            endif; 
        }catch(Exception $exception){
            session()->flash('alert', 'No se completo el inicio de sesión: '.$exception->getMessage());
            session()->flash('alert-type', 'warning');
            return Redirect::route('login');
        }
    }
}
