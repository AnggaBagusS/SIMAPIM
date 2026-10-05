<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\StorePetugasRequest;
use App\Http\Requests\UpdatePetugasRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class PetugasController extends Controller
{
    public function create()
    {
        return view('petugas.create');
    }

    public function store(StorePetugasRequest $request)
    {
        $validated = $request->validated();

        $user = new User();
        $user->firstname = $validated['firstname'];
        $user->lastname = $validated['lastname'] ?? null;
        $user->email = $validated['email'];
        $user->password = Hash::make($validated['password']);
        $user->type = $validated['type'];

        // Handle avatar upload via Laravel Storage API
        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = basename($path);
        } else {
            $user->avatar = 'no-image-available.png';
        }

        $user->save();

        return redirect()->route('petugas.index')->with('success', 'Petugas berhasil ditambahkan.');
    }

    public function index()
    {
        $users = User::where('type', '!=', null)->paginate(10);
        return view('petugas.index', compact('users'));
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('petugas.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('petugas.edit', compact('user'));
    }

    public function update(UpdatePetugasRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $validated = $request->validated();

        // Update data umum
        $user->firstname = $validated['firstname'];
        $user->lastname = $validated['lastname'] ?? null;
        $user->email = $validated['email'];
        $user->type = $validated['type'];

        // Update password jika diisi
        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        // Update avatar jika ada file baru via Laravel Storage API
        if ($request->hasFile('avatar')) {
            if ($user->avatar && $user->avatar !== 'no-image-available.png' && Storage::disk('public')->exists('avatars/' . $user->avatar)) {
                Storage::disk('public')->delete('avatars/' . $user->avatar);
            }

            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = basename($path);
        }

        $user->save();

        return redirect()->route('petugas.index')->with('success', 'Petugas berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        
        // Hapus file avatar via Laravel Storage API jika bukan default
        if ($user->avatar && $user->avatar !== 'no-image-available.png' && Storage::disk('public')->exists('avatars/' . $user->avatar)) {
            Storage::disk('public')->delete('avatars/' . $user->avatar);
        }

        $user->delete();

        return redirect()->route('petugas.index')->with('success', 'User berhasil dihapus.');
    }
}
