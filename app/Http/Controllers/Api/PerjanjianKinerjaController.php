<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PerjanjianKinerjaResource;
use App\Models\PerjanjianKinerja;
use Illuminate\Http\Request;

class PerjanjianKinerjaController extends Controller
{
    /**
     * Display a listing of Perjanjian Kinerja documents.
     */
    public function index(Request $request)
    {
        $query = PerjanjianKinerja::with(['opd', 'tahun.periode', 'user']);

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
            $query->whereHas('tahun', function($q) use ($request) {
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
            return PerjanjianKinerjaResource::collection($documents);
        }

        $documents = $query->paginate($perPage);

        return PerjanjianKinerjaResource::collection($documents);
    }

    /**
     * Display the specified Perjanjian Kinerja document.
     */
    public function show($id)
    {
        $document = PerjanjianKinerja::with(['opd', 'tahun.periode', 'user'])->findOrFail($id);

        return new PerjanjianKinerjaResource($document);
    }
}
