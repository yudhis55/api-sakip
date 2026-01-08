<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RenjaResource;
use App\Models\Renja;
use Illuminate\Http\Request;

class RenjaController extends Controller
{
    /**
     * Display a listing of Renja documents.
     */
    public function index(Request $request)
    {
        $query = Renja::with(['opd', 'tahun.periode', 'user']);

        // Filter by OPD
        if ($request->has('opd_id')) {
            $query->where('id_perangkat_daerah', $request->opd_id);
        }

        // Filter by tahun
        if ($request->has('tahun_id')) {
            $query->where('id_tahun', $request->tahun_id);
        }

        // Filter by tahun value
        if ($request->has('tahun')) {
            $query->whereHas('tahun', function ($q) use ($request) {
                $q->where('tahun', $request->tahun);
            });
        }

        // Filter by status
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        // Filter by kategori
        if ($request->has('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        // Only published documents
        if ($request->boolean('published_only', false)) {
            $query->whereNotNull('tgl_publish');
        }

        // Sorting
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        // Pagination
        $perPage = $request->get('per_page', 15);

        if ($request->boolean('all', false)) {
            $documents = $query->get();
            return RenjaResource::collection($documents);
        }

        $documents = $query->paginate($perPage);

        return RenjaResource::collection($documents);
    }

    /**
     * Display the specified Renja document.
     */
    public function show($id)
    {
        $document = Renja::with(['opd', 'tahun.periode', 'user'])->findOrFail($id);

        return new RenjaResource($document);
    }
}
