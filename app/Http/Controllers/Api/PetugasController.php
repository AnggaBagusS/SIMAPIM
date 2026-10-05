<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\UserResource;

class PetugasController extends Controller
{
    /**
     * Dapatkan daftar seluruh petugas/staff aktif.
     */
    public function index(Request $request)
    {
        $query = User::where('type', 2); // Hanya staff / petugas

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('firstname', 'like', "%{$search}%")
                  ->orWhere('lastname', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $query->orderBy('firstname', 'asc');

        if ($request->boolean('all', true)) {
            $users = $query->get();
            return response()->json([
                'success' => true,
                'message' => 'Daftar petugas berhasil dimuat.',
                'data'    => UserResource::collection($users),
            ]);
        }

        $paginated = $query->paginate(15);
        return UserResource::collection($paginated)->additional([
            'success' => true,
            'message' => 'Daftar petugas berhasil dimuat.',
        ]);
    }

    /**
     * Dapatkan rincian satu petugas beserta agenda tugasnya.
     */
    public function show($id)
    {
        $user = User::where('type', 2)->find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Petugas tidak ditemukan.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail petugas berhasil dimuat.',
            'data'    => new UserResource($user),
        ]);
    }
}
