<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Models\User;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use GuzzleHttp\Client;
use Illuminate\Http\Response;

class PassportController extends Controller
{
    public function login(Request $request){
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);

        $message = "error";
        $errors = ['email' => 'correo no encontrado'];
        $code = 404;
        $access_token = null;
        $token_type = null;
        $expires_at = null;
        $users = null;

        if($user = User::whereEmail($request->email)->where('type','admin')->first()){
            $errors = ['password' => 'Contraseña incorrecta'];
            if(Hash::check($request->password, $user->password)){
                $code = 200;
                $message = 'success';
                $errors = [];
                $tokenResult = $user->createToken('Acceso PIXZELLE');
                
                $token = $tokenResult->token;
                if ($request->remember_me)
                    $token->expires_at = Carbon::now()->addWeeks(1);
                $token->save();

                $access_token = $tokenResult->accessToken;
                $token_type = 'Bearer';
                $expires_at = Carbon::parse($token->expires_at)->toDateTimeString();
                $users = $user;
            }
        }
        
        return response()->json([
            'message' => $message,
            'errors' => $errors,
            'access_token' => $access_token,
            'token_type' => $token_type,
            'expires_at' => $expires_at,
            'user' => $users,
        ],$code);

    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return $request->wantsJson()
            ? new Response('', 204)
            : redirect('/');
    }

    public function user(Request $request)
    {
        //$request->user()->notify(new NotificationTest($request->user()));
        return response()->json([
            'user' => $request->user()
        ]);
    }
}
