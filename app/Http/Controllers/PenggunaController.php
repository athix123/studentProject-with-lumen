<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Pengguna;

class PenggunaController extends Controller
{
    public function register(Request $request)
    {
        $hasher = app()->make('hash');

        $pengguna = new Pengguna;
        $pengguna->namaPengguna = $request->input('username');
        $pengguna->namaLengkap = $request->input('fullname');
        $pengguna->jenisKelamin = $request->input('gender');
        $pengguna->tanggalLahir = $request->input('birthday');
        $pengguna->email = $request->input('email');
        $pengguna->noHp = $request->input('phone');

        $pengguna->sandi = $hasher->make($request->input('password'));
        $pengguna->save();

        if ($request) {

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

        $namaPengguna = $request->input('username');
        $sandi = $request->input('password');

        $login = Pengguna::where('namaPengguna', $namaPengguna)->first();

        if (!$login) {
            
            $res['success'] = false;
            $res['message'] = 'User not found';

            return response($res, 404);

        }else{

            if ($hasher->check($sandi, $login->sandi)) {
                $token = sha1(time());

                $create_token = Pengguna::where('id', $login->id)->update(['token' => $token]);
                
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
