<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\StoreRequest;
use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use function PHPUnit\Framework\returnSelf;

class AuthController extends Controller
{
    use HttpResponses;

    public function login(LoginRequest $loginRequest)
    {
        $loginRequest->validated($loginRequest->all());


        // if (!Auth::attempt(['email' => $loginRequest->email, 'password' => $loginRequest->passwpord])) {
        //     return $this->erorr('', 'Credentials do not Match', 401);
        // }

        $email = $loginRequest->email;
        $password = $loginRequest->passwpord;
        if (!Auth::attempt($loginRequest->only([$email,$password]))) {
            return $this->erorr('', 'Credentials do not Match', 401);
        }


        $user = User::where('email', $email)->first();
        return $this->success([
            'user' => $user,
            'token' => $user->createToken('API Token of' . $user->name)->plainTextToken
        ]);


    }


    public function register(StoreRequest $storeRequest)
    {
        $storeRequest->validated($storeRequest->all());
        $user = User::create([
            'name' => $storeRequest->name,
            'email' => $storeRequest->email,
            'password' => Hash::make($storeRequest->password)

        ]);
        return $this->success([
            'user' => $user,
            'token' => $user->createToken('API token of ' . $user->name)->plainTextToken
        ]);

        //"token": "1|Nj6YORNnE7j6c1a7jFzyCya7tzYOiB3suEk9rMga2ab00743"

    }



    public function logout()
    {
        // Auth::user()->currentAccessToken()->delete();

        return  $this->success([
            'message' =>' You have been logged out and your token has been deleted'
        ]);
    }
}
