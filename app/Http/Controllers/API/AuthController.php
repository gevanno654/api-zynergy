<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Mail\EmailVerification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Ada kesalahan',
                'data' => $validator->errors()
            ], 422);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);

        // Generate a single 5-digit OTP
        $otp = str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT);

        // Save OTP and creation time to user
        $user->verification_codes = $otp;
        $user->verification_codes_created_at = now();
        $user->save();

        // Send email with OTP
        Mail::to($user->email)->send(new EmailVerification($otp));

        $success['token'] = $user->createToken('auth_token')->plainTextToken;
        $success['name'] = $user->name;

        return response()->json([
            'success' => true,
            'message' => 'Sukses mendaftar, silahkan verifikasi Email anda!',
            'data' => $success
        ]);
    }

    public function verifyEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'otp' => 'required|string|size:5',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Ada kesalahan',
                'data' => $validator->errors()
            ], 422);
        }

        $user = Auth::user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found',
                'data' => null
            ], 404);
        }

        // Check if OTP is still valid (10 minutes)
        if ($user->verification_codes_created_at && now()->diffInMinutes($user->verification_codes_created_at) > 10) {
            return response()->json([
                'success' => false,
                'message' => 'Verification code has expired',
                'data' => null
            ], 400);
        }

        if ($request->otp === $user->verification_codes) {
            $user->email_verified_at = now();
            $user->verification_codes = null;
            $user->verification_codes_created_at = null;
            $user->save();

            // Generate token for automatic login
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'success' => true,
                'message' => 'Email verified successfully',
                'data' => [
                    'token' => $token,
                    'user' => $user,
                ]
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Verification code does not match',
                'data' => null
            ], 400);
        }
    }

    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $auth = Auth::user();
            $success['token'] = $auth->createToken('auth_token')->plainTextToken;
            $success['name'] = $auth->name;
            $success['email'] = $auth->email;

            return response()->json([
                'success' => true,
                'message' => 'Sukses login',
                'data' => $success
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Cek email dan password lagi',
                'data' => null
            ], 401);
        }
    }

    public function logout(Request $request)
    {
        // Hapus token akses pengguna
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Sukses logout',
            'data' => null
        ]);
    }
}
