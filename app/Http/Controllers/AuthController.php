<?php

namespace App\Http\Controllers;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Http\Request;

use App\Models\pegawai;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $status = pegawai::create([
            'NIP'=> $request->NIP,
            'nama'=> $request->nama,
            'password' => Hash::make($request->password),
            'OPD' => $request->OPD,
            'id_status' => $request-> id_status,
            'id_jabatan' => $request-> id_jabatan,
        ]);
        $token = Auth::login($status);
        return response()->json([
            'data' => $status,
            'message' => 'User created successfully',
            'pegawai' => $status,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer'
            ]
        ], 200);
    }

    public function login()
    {
        $credentials = request(['NIP', 'password']);
        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
