<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array for API output.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $avatarName = $this->avatar ?: 'no-image-available.png';
        $avatarUrl = asset('storage/avatars/' . $avatarName);

        return [
            'id'         => $this->id,
            'firstname'  => $this->firstname,
            'lastname'   => $this->lastname,
            'fullname'   => trim($this->firstname . ' ' . ($this->lastname ?? '')),
            'email'      => $this->email,
            'type'       => (int) $this->type,
            'role'       => $this->type == 1 ? 'admin' : 'staff',
            'role_label' => $this->type == 1 ? 'Administrator' : 'Petugas',
            'avatar'     => $avatarName,
            'avatar_url' => $avatarUrl,
            'created_at' => $this->created_at ? $this->created_at->toISOString() : null,
        ];
    }
}
