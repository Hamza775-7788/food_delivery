<?php

namespace App\Http\Controllers;

use App\Mail\CodeMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function signUp(Request $request)
    {
        $request->validate([
            "name" => 'required|string|unique:users,name,' . Auth::id(),
            "email" => 'required|email|unique:users,email,' . Auth::id(),
            "password" => 'required|string|min:8'
        ]);
        $verificationCode = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        User::updateOrCreate(
            ['email' => $request->email],
            [
                'name' => $request->name,
                'password' => Hash::make($request->password),
                'verification_code' => $verificationCode,
                'code_expires_at' => now()->addMinutes(10) // صلاحية 10 دقائق
            ]
        );
        $user = User::where("email", $request->email)->firstOrFail();
        Mail::to($user->email)->send(new CodeMail($verificationCode));
        $token = $user->createToken("auth_token")->plainTextToken;

        return response()->json([
            "status" => true,
            "user" => $user,
            "token" => $token
        ], 200);
    }

    public function signIn(Request $request)
    {
        $request->validate([
            "email" => 'required|email',
            "password" => 'required|string'
        ]);
        if (!Auth::attempt($request->only("email", 'password'))) {
            return response()->json(["status" => false, "message" => "user-not-found"]);
        } else {
            $user = User::where('email', $request->email)->first();
            $user->tokens()->delete();
            $token = $user->createToken("auth_token")->plainTextToken;
            return response()->json(["status" => true, "user" => $user, "token" => $token]);
        }
    }

    public function forgot(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json(["status" => false, "message" => "user-not-found"]);
        } else {
            $verificationCode = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
            $user->update([
                'verification_code' => $verificationCode,
                'code_expires_at' => now()->addMinutes(10)
            ]);
            Mail::to($user->email)->send(new CodeMail($verificationCode));
            return response()->json(["status" => true, "message" => "code-sent"]);
        }
    }


    public function verifyCode(Request $request)
    {
        $request->validate([
            'code' => 'required|digits:6',
            "email" => 'required|email',
        ]);

        $user = User::where('email', $request->user()->email)
            ->where('verification_code', $request->code)
            ->where('code_expires_at', '>', now())
            ->first();

        if (!$user) {
            return response()->json(["status" => false], 401);
        }
        $user->update([
            'email_verified_at' => now(),
            'verification_code' => null,
            'code_expires_at' => null
        ]);

        return response()->json(['status' => true]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
        $user = User::where('email', $request->email)->first;
        $user->update([
            'password' => Hash::make($request->password),
        ]);
        $token = $user->createToken("auth_token")->plainTextToken;

        return response()->json([
            "status" => true,
            "user" => $user,
            "token" => $token
        ], 200);
    }
}
