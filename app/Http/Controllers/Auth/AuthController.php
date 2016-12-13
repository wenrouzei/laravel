<?php
/**
 * github 第三方登录测试
 */
namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Socialite, Auth;
use App\User;

class AuthController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('github')->redirect();
    }
    
    public function handleProviderCallback()
    {
        try {
            $user = Socialite::driver('github')->user();
        } catch (Exception $e) {
            return Redirect::to('auth/github');
        }

        \Session::put('user', $user);
        // var_dump(\Session::get('user'));
        
        // $authUser = $this->findOrCreateUser($user);

        // Auth::login($authUser, true);
        // Auth::login($user, true);
    
        // return redirect('/home');
        return redirect('/activities');
    }
    
    private function findOrCreateUser($githubUser)
    {
        if ($authUser = User::where('github_id', $githubUser->id)->first()) {
            return $authUser;
        }

        return User::create([
            'name' => $githubUser->name,
            'email' => $githubUser->email,
            'github_id' => $githubUser->id,
            'avatar' => $githubUser->avatar
        ]);
    }
}
