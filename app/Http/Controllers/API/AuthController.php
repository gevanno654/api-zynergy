<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
    
        // Check if OTP is still valid (1 minutes)
        if ($user->verification_codes_created_at && now()->diffInMinutes($user->verification_codes_created_at) > 1) {
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
    
    public function resendOTP(Request $request)
    {
        $user = Auth::user();
    
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found',
                'data' => null
            ], 404);
        }
    
        // Generate a single 5-digit OTP
        $otp = str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT);
    
        // Save OTP and creation time to user
        $user->verification_codes = $otp;
        $user->verification_codes_created_at = now();
        $user->save();
    
        // Send email with OTP
        Mail::to($user->email)->send(new EmailVerification($otp));
    
        return response()->json([
            'success' => true,
            'message' => 'OTP sent successfully',
            'data' => null
        ]);
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
    
    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'data' => $validator->errors()
            ], 422);
        }

        // Ambil pengguna yang sedang login
        $user = $request->user();

        // Periksa apakah pengguna sudah terautentikasi
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not authenticated',
            ], 401);
        }

        // Verifikasi password saat ini
        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Current password is incorrect',
            ], 400);
        }

        // Update password
        $user->password = Hash::make($request->new_password);
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Password changed successfully',
        ]);
    }
    
    public function updateName(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
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

        $user->name = $request->name;
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Nama berhasil diubah',
            'data' => [
                'user' => $user
            ]
        ]);
    }
}
