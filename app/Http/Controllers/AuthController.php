<?php

namespace App\Http\Controllers;


use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

/**
 * Class AuthController
 *
 * @package App\Http\Controllers
 */
class AuthController extends Controller
{
    public function register() {
        $data = $this->validate(request(), [
            'email' => 'required|email|min:6|max:60',
            'password' => 'required|min:6|max:60',
            'name' => 'required|min:0|max:100'
        ]);

        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);
        if(is_null($user))
            $this->error(400, 'Error');

        return $this->success($user);
    }


    public function login(){

        $data = $this->validate(request(),[
            'email' => 'required|email|min:6|max:60',
            'password' => 'required|min:6|max:60',
            'remember_me' => 'sometimes|boolean'
        ]);

        $rememberMe = false;
        if (isset($data['remember_me'])) {
            $rememberMe = (bool) $data['remember_me'];
            unset($data['remember_me']);
        }

        /** @var User $user */
        $user = User::where('email', $data['email'])->first();

        if (!$user) {
            abort(400, 'Email is not exists');
        }

        if(!Hash::check($data['password'], $user->password)){
            abort(400, 'Email or password is not correct');
        }

        $tokenResult = $user->createToken('Personal Access Token');
        /** @var \Laravel\Passport\Token $token */
        $token = $tokenResult->token;

        if ($rememberMe) {
            $token->expires_at = Carbon::now()->addWeeks(1);
        }

        $token->save();

        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
    }

    /**
     * Get the authenticated User
     *
     */
    public function user()
    {
        /** @var User $user */
        $user = request()->user('api');
        return $this->success($user);
    }

    public function logout() {
        /** @var User $user */
        $user = request()->user();
        $token = $user->token();
        $token->revoke();
        return $this->success('You have been successfully logged out!');
    }

}
