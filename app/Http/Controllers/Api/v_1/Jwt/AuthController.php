<?php

namespace App\Http\Controllers\Api\v_1\Jwt;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $user = User::where('email', '=', $request->email)->first();
        if(!Hash::check($request->password, $user->password)) {
            return response()->json([
                'success'=>false,
                'message'=>[
                    __('auth.name_exists')
                ]
            ], 403);
        }

        $remember = boolval(request('remember_me'));
        $token = auth('api')->attempt($request->only(['email', 'password']));

        if (!$token) {
            return response()->json([
                'success' => false,
                'message' => [
                    __('auth.fail_join')
                ]
            ], 401);
        }

        return $this->respondWithToken($token, $remember);
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
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'user' => auth('api')->user()->only(['id', 'email', 'name', 'created_at', 'user_status']),
        ]);
    }
}