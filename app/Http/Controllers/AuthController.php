<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pegawai;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

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
            'NIP' => $request->NIP,
            'nama' => $request->nama,
            'password' => Hash::make($request->password),
            'OPD' => $request->OPD,
            'id_status' => $request->id_status,
            'id_jabatan' => $request->id_jabatan,
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

    public function login(Request $request)
    {
        
        $request->validate([
            'NIP'=> 'required|string',
            'password' => 'required',
        ]);

        $credentials = $request->only( 'NIP','password');

        $token = JWTAuth::attempt($credentials);
        if (!$token) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Unauthorized'
                ],401);
            }
        $user = JWTAuth::user();
        return response()->json([
            'status' => 'success',
            'pegawai' => $user,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer'
            ]
        ]);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json([
            'status' => 'success',
            'pegawai' => Auth::user()
        ]);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        Auth::logout();
        return response()->json([
            'status' => 'success',
            'message' => ' Successfullt logged out'
        ]);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return response()->json([
            'status' => 'success',
            'pegawai' => Auth::user(),
            'authorisation' => [
                'token' => Auth::refresh(),
                'type' => 'bearer'
            ]
        ]);
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
            'refresh' => $this->respondWithToken(auth()->refresh()),
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
