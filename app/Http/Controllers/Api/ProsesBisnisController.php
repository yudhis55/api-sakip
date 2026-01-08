<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProsesBisnisResource;
use App\Models\ProsesBisnis;
use Illuminate\Http\Request;

class ProsesBisnisController extends Controller
{
    /**
     * Display a listing of Proses Bisnis documents.
     */
    public function index(Request $request)
    {
        $query = ProsesBisnis::with(['opd', 'periode', 'user']);

        // Filter by OPD
        if ($request->has('opd_id')) {
            $query->where('id_perangkat_daerah', $request->opd_id);
        }

        // Filter by periode
        if ($request->has('periode_id')) {
            $query->where('id_periode', $request->periode_id);
        }

        // Filter by status
        if ($request->has('status')) {
            $query->where('status', $request->status);
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
            return ProsesBisnisResource::collection($documents);
        }

        $documents = $query->paginate($perPage);

        return ProsesBisnisResource::collection($documents);
    }

    /**
     * Display the specified Proses Bisnis document.
     */
    public function show($id)
    {
        $document = ProsesBisnis::with(['opd', 'periode', 'user'])->findOrFail($id);

        return new ProsesBisnisResource($document);
    }
}
