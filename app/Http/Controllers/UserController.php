<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateProfileRequest;

class UserController extends Controller
{
    // Tampilkan halaman edit profil
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    // Update profil mandiri
    public function update(UpdateProfileRequest $request)
    {
        $user = Auth::user();
        $validated = $request->validated();

        if (!empty($validated['firstname'])) {
            $user->firstname = $validated['firstname'];
        }

        if (array_key_exists('lastname', $validated)) {
            $user->lastname = $validated['lastname'];
        }

        if (!empty($validated['email'])) {
            $user->email = $validated['email'];
        }

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        if ($request->hasFile('avatar')) {
            // Hapus avatar lama via Laravel Storage API jika bukan default
            if ($user->avatar && $user->avatar !== 'no-image-available.png' && Storage::disk('public')->exists('avatars/' . $user->avatar)) {
                Storage::disk('public')->delete('avatars/' . $user->avatar);
            }

            // Simpan avatar baru via Laravel Storage API
            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = basename($path);
        }

        $user->save();

        if (auth()->user()->type == 1) {
            return redirect('/')->with('success', 'Profil berhasil diperbarui.');
        } else {
            return redirect('/dashboard-staff')->with('success', 'Profil berhasil diperbarui.');
        }
    }
}
