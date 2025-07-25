<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Tampilkan halaman edit profil
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    // Update profil
    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'firstname' => 'nullable|string|max:200',
            'lastname' => 'nullable|string|max:200',
            'email' => 'nullable|email|max:200|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if (!empty($validated['firstname'])) {
            $user->firstname = $validated['firstname'];
        }

        if (!empty($validated['lastname'])) {
            $user->lastname = $validated['lastname'];
        }

        if (!empty($validated['email'])) {
            $user->email = $validated['email'];
        }

        if (!empty($validated['password'])) {
            $user->password = bcrypt($validated['password']);
        }

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filename = time() . '_' . $file->getClientOriginalName();

            $oldAvatarPath = public_path('storage/avatars/' . $user->avatar);
            if (file_exists($oldAvatarPath)) {
                @unlink($oldAvatarPath);
            }

            $file->move(public_path('storage/avatars'), $filename);
            $user->avatar = $filename;
        }

        $user->save();

        if (auth()->user()->type == 1) {
            return redirect('/')->with('success', 'Profil berhasil diperbarui.');
        } else {
            return redirect('/dashboard-staff')->with('success', 'Profil berhasil diperbarui.');
        }


    }

}
