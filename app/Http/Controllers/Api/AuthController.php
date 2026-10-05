<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Login API dan generate Sanctum Bearer Token.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email'       => 'required|email',
            'password'    => 'required|string',
            'device_name' => 'nullable|string|max:100',
        ], [
            'email.required'    => 'Email wajib diisi.',
            'email.email'       => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Email atau password yang Anda masukkan salah.',
            ], 401);
        }

        $deviceName = $request->device_name ?: 'Mobile App (' . ($request->header('User-Agent') ?: 'Unknown Device') . ')';
        $token = $user->createToken($deviceName)->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Login berhasil.',
            'data'    => [
                'user'         => new UserResource($user),
                'access_token' => $token,
                'token_type'   => 'Bearer',
            ],
        ]);
    }

    /**
     * Dapatkan informasi user yang sedang login saat ini.
     */
    public function me(Request $request)
    {
        return response()->json([
            'success' => true,
            'message' => 'Data profil pengguna berhasil diambil.',
            'data'    => new UserResource($request->user()),
        ]);
    }

    /**
     * Perbarui profil akun mandiri via API.
     */
    public function updateProfile(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'firstname' => 'nullable|string|max:200',
            'lastname'  => 'nullable|string|max:200',
            'email'     => 'nullable|email|max:200|unique:users,email,' . $user->id,
            'password'  => 'nullable|string|min:6',
            'avatar'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->filled('firstname')) {
            $user->firstname = $request->firstname;
        }

        if ($request->has('lastname')) {
            $user->lastname = $request->lastname;
        }

        if ($request->filled('email')) {
            $user->email = $request->email;
        }

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        if ($request->hasFile('avatar')) {
            if ($user->avatar && $user->avatar !== 'no-image-available.png' && Storage::disk('public')->exists('avatars/' . $user->avatar)) {
                Storage::disk('public')->delete('avatars/' . $user->avatar);
            }

            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = basename($path);
        }

        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Profil berhasil diperbarui.',
            'data'    => new UserResource($user),
        ]);
    }

    /**
     * Logout dan revokasi access token saat ini.
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logout berhasil. Token telah dicabut.',
        ]);
    }
}
