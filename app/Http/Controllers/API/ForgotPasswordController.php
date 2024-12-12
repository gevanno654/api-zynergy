<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    public function sendResetCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'data' => $validator->errors()
            ], 422);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found',
            ], 404);
        }

        // Generate a 5-digit OTP
        $otp = str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT);

        // Save OTP and creation time to user
        $user->verification_codes = $otp;
        $user->verification_codes_created_at = now();
        $user->save();

        // Send email with OTP
        Mail::to($user->email)->send(new ResetPasswordMail($otp));

        return response()->json([
            'success' => true,
            'message' => 'Reset password code sent to your email',
        ]);
    }
    
    public function verifyOTP(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'otp' => 'required|string|size:5',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'data' => $validator->errors()
            ], 422);
        }
    
        // Cari pengguna berdasarkan email
        $user = User::where('email', $request->email)->first();
    
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found',
            ], 404);
        }
    
        // Periksa apakah OTP masih valid (misalnya, 10 menit)
        if ($user->verification_codes_created_at && now()->diffInMinutes($user->verification_codes_created_at) > 10) {
            return response()->json([
                'success' => false,
                'message' => 'Verification code has expired',
            ], 400);
        }
    
        // Periksa apakah OTP sesuai
        if ($request->otp !== $user->verification_codes) {
            return response()->json([
                'success' => false,
                'message' => 'Verification code does not match',
            ], 400);
        }
    
        // Jika OTP valid, kembalikan respons sukses
        return response()->json([
            'success' => true,
            'message' => 'OTP verified successfully',
        ]);
    }

    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'otp' => 'required|string|size:5',
            'password' => 'required|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'data' => $validator->errors()
            ], 422);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found',
            ], 404);
        }

        // Check if OTP is still valid (10 minutes)
        if ($user->verification_codes_created_at && now()->diffInMinutes($user->verification_codes_created_at) > 5) {
            return response()->json([
                'success' => false,
                'message' => 'Verification code has expired',
            ], 400);
        }

        if ($request->otp !== $user->verification_codes) {
            return response()->json([
                'success' => false,
                'message' => 'Verification code does not match',
            ], 400);
        }

        // Update user password
        $user->password = bcrypt($request->password);
        $user->verification_codes = null;
        $user->verification_codes_created_at = null;
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Password reset successfully',
        ]);
    }
}
