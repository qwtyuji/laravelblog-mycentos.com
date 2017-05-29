<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GithubController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('github')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('github')->user();
        $data = User::where('email', $user->email)->first();
        if (!$data) {
            $userModel = new User;
            $userModel->github_id = $user->id;
            $userModel->github_name = $user->name;
            $userModel->github_nickname = $user->nickname;
            $userModel->email = $user->email;
            $userModel->name = $user->nickname;
            $userModel->avatar = $user->avatar;
            $userModel->save();
        }
        $userInstance = User::where('github_id', $user->id)->firstOrFail();
        Auth::login($userInstance);
        return back();
    }
}
