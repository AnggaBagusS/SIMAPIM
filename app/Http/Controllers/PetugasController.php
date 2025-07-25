<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class PetugasController extends Controller
{
    public function create()
    {
        return view('petugas.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'firstname' => 'required|string|max:200',
            'lastname' => 'nullable|string|max:200',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'type' => 'required|in:1,2', // 1=Admin, 2=Petugas
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = new User();
        $user->firstname = $validated['firstname'];
        $user->lastname = $validated['lastname'];
        $user->email = $validated['email'];
        $user->password = Hash::make($validated['password']);
        $user->type = $validated['type'];

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            $filename = time() . '_' . $request->file('avatar')->getClientOriginalName();
            $request->file('avatar')->move(public_path('storage/avatars'), $filename);
            $user->avatar = $filename;
        } else {
            $user->avatar = 'no-image-available.png';
        }

        $user->save();

        return redirect()->route('petugas.create')->with('success', 'Petugas berhasil ditambahkan.');
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

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        
        // Hapus file avatar jika ada
        if ($user->avatar && file_exists(public_path('storage/avatars/' . $user->avatar))) {
            unlink(public_path('storage/avatars/' . $user->avatar));
        }

        $user->delete();

        return redirect()->route('petugas.index')->with('success', 'User berhasil dihapus.');
    }

}
