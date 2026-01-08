<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LkjipResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'file' => $this->file,
            // 'file_url' => $this->file ? url('storage/' . $this->file) : null,
            'file_url' => $this->file ? $this->getFileUrl() : null,
            'keterangan' => $this->keterangan,
            'tanggapan' => $this->tanggapan,
            'tanggal_publish' => $this->tgl_publish?->format('Y-m-d'),
            'status' => $this->status,
            'opd' => new OpdResource($this->whenLoaded('opd')),
            'tahun' => new TahunSakipResource($this->whenLoaded('tahun')),
            'user' => new UserResource($this->whenLoaded('user')),
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
        ];
    }

    /**
     * Get file URL with PPT viewer prefix if needed
     */
    protected function getFileUrl()
    {
        $baseUrl = 'https://e-sakip.trenggalekkab.go.id/preview/lkjip/';
        $storageUrl = 'https://e-sakip.trenggalekkab.go.id/storage/lkjip/';
        $url = $storageUrl . $this->file;
        $extension = strtolower(pathinfo($this->file, PATHINFO_EXTENSION));

        if (in_array($extension, ['ppt', 'pptx'])) {
            return 'https://view.officeapps.live.com/op/view.aspx?src=' . $url;
        }

        return $baseUrl . $this->file;
    }
}
