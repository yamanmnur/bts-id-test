<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\Users\UsersResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class AuthController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth:api', ['except' => ['signin', 'signup']]);
    }

    public function index() {
      $user = User::orderBy('created_at','desc')->get();

      return response()->json(
        UsersResource::collection($user)
      ,200);
    }

    public function signup(Request $request)
    {
        $validator = FacadesValidator::make($request->user, [
            'username' => 'required|string|min:2|max:100',
            'email' => 'required|string|email|max:100|unique:users',
            'encrypted_password' => 'required|string|min:6',
            'phone' => 'required|string|min:12',
            'city' => 'required|string|max:200',
            'country' => 'required|string|max:100',
            'name' => 'required|string|max:200',
            'address' => 'required|string',
            'postcode' => 'required|string|max:6',
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = User::create([
          'name' => $request->user['name'],
          'email' => $request->user['email'],
          'username' => $request->user['username'],
          'phone' => $request->user['phone'],
          'city' => $request->user['city'],
          'country' => $request->user['country'],
          'name' => $request->user['name'],
          'postcode' => $request->user['postcode'],
          'address' => $request->user['address'],
          'password' => Hash::make($request->user['encrypted_password'])
        ]);

        $token = auth()->attempt([
          'email' => $request->user['email'],
          'password' => $request->user['encrypted_password']
        ]);

        return response()->json([
            'email' => $request->user['email'],
            'token' => $token,
            'username' => $request->user['username']
        ], 201);
    }

    public function signin(Request $request)
    {
        $validator = FacadesValidator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if (!$token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token, $request->email, FacadesAuth::user()->username);
    }

    protected function respondWithToken($token, $email, $username)
    {
        return response()->json([
          'email' => $email,
          'token' => $token,
          'username' => $username,
        ]);
    }
}