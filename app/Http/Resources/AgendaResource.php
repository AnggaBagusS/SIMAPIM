<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AgendaResource extends JsonResource
{
    /**
     * Transform the resource into an array for API output.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $sambutanUrl = $this->file_sambutan
            ? asset('storage/sambutan/' . $this->file_sambutan)
            : null;

        $currentUserId = auth('sanctum')->id();
        $isAssigned = false;

        if ($currentUserId) {
            if ($this->relationLoaded('petugas')) {
                $isAssigned = $this->petugas->contains('id', $currentUserId);
            } elseif (!empty($this->user_ids)) {
                $isAssigned = in_array((string)$currentUserId, explode(',', (string)$this->user_ids));
            }
        }

        return [
            'id'                => $this->id,
            'judul_acara'       => $this->judul_acara,
            'tanggal'           => $this->tanggal,
            'hari'              => $this->hari,
            'jam_mulai'         => $this->jam_mulai ? substr($this->jam_mulai, 0, 5) : null,
            'jam_selesai'       => $this->jam_selesai ? substr($this->jam_selesai, 0, 5) : null,
            'waktu_formatted'   => $this->waktu_formatted,
            'status'            => $this->status ?? 'terjadwal',
            'status_label'      => $this->status_badge['label'] ?? ucfirst($this->status),
            'lokasi'            => $this->lokasi,
            'pejabat'           => $this->pejabat,
            'link_dokumentasi'  => $this->link,
            'file_sambutan'     => $this->file_sambutan,
            'file_sambutan_url' => $sambutanUrl,
            'is_assigned_to_me' => $isAssigned,
            'petugas'           => UserResource::collection($this->whenLoaded('petugas')),
            'date_created'      => $this->date_created,
        ];
    }
}
