<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'nama_pemohon' => strtoupper($this->name),
            'emel' => '<a href="mailto:' . $this->email . '">' . $this->email . '</a>',
            'pengesahan_emel' =>
            !is_null($this->email_verified_at)
                ? $this->email_verified_at->format('d/m/Y H:i A')
                : null,
            'tahun_daftar' => $this->created_at->year,
            'bulan_daftar' => $this->created_at->monthName,
            'hari_daftar' => $this->created_at->dayName,
            'umur_akaun' => $this->created_at->diffForHumans(),
            'applications' => $this->whenLoaded('applications')
        ];
    }
}
