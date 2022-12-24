<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\pegawai;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
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
            'NIP' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('NIP', 'password');
        $token = Auth::attempt($credentials);
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized'
            ],401);
        }
        
        $pegawai = Auth::user();
        return response()->json([
            'status' => 'success',
            'pegawai' => $pegawai,
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
