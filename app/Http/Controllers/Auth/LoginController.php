<?php

namespace App\Http\Controllers\Auth;


use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
    public function __invoke(LoginRequest $request){

        $user = User::where(['email' => $request->email])->first();
      // dd( $user );
           if(!$user  || !Hash::check($request->password, $user->password)){

          return response('Credential not match.', Response:: HTTP_UNAUTHORIZED);
       }

           $token = $user->createToken('api');
            return response(['token' => $token->plainTextToken]);
        }
}
