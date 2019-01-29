<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $hasher = app()->make('hash');

        $username = $request->input('username');

        $password = $hasher->make($request->input('password'));

        $register = User::create([
            'username'=> $username,
            'password'=> $password
        ]);

        if ($register) {

            $res['success'] = true;
            $res['message'] = 'Success register!';

            return response()->json($res, 203);

        }else{

            $res['success'] = false;
            $res['message'] = 'Failed to register!';

            return response()->json($res, 403);
        }
    }
    
    public function login(Request $request)
    {
        $hasher = app()->make('hash');

        $username = $request->input('username');
        $password = $request->input('password');

        $login = User::where('username', $username)->first();

        if (!$login) {
            
            $res['success'] = false;
            $res['message'] = 'User not found';

            return response($res, 404);

        }else{
            
            if ($hasher->check($password, $login->password)) {

                $token = sha1(time());

                $create_token = User::where('id', $login->id)->update(['token' => $token]);
                
                if ($create_token) {
                   
                    $res['success'] = true;
                    $res['token'] = $token;
                    $res['message'] = $login;

                    return response()->json($res, 200);
                }

            }else{

                $res['success'] = false;
                $res['message'] = 'You username or password incorrect!';

                return response()->json($res, 400);
            }
        }
    }
}
