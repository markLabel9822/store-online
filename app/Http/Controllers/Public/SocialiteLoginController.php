<?php


namespace App\Http\Controllers\Public;


use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\UserPublic;
use Illuminate\Support\Facades\Redirect;

class SocialiteLoginController extends Controller
{

    public function redirectToProvider($provider)
    {

        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();
        $findUser = UserPublic::where('google_id', $user->id)->first();

        if ($findUser) {
            Auth::login($findUser);
            Auth::guard('public_users')->login($findUser);
        } else {
            $newUser = UserPublic::create([
                'name' => $user->name,
                'email' => $user->email,
                'google_id' => $user->id,
                'password' => bcrypt('password'),
            ]);

            Auth::guard('public_users')->login($newUser);
        }

        return Redirect::back();
    }
}
