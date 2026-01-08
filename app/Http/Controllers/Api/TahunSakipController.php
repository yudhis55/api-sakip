<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TahunSakipResource;
use App\Models\TahunSakip;
use Illuminate\Http\Request;

class TahunSakipController extends Controller
{
    /**
     * Display a listing of tahun.
     */
    public function index(Request $request)
    {
        $query = TahunSakip::with('periode');

        // Filter by periode
        if ($request->has('periode_id')) {
            $query->where('id_periode', $request->periode_id);
        }

        // Filter by specific tahun
        if ($request->has('tahun')) {
            $query->where('tahun', $request->tahun);
        }

        // Pagination
        $perPage = $request->get('per_page', 15);

        if ($request->boolean('all', false)) {
            $tahuns = $query->get();
            return TahunSakipResource::collection($tahuns);
        }

        $tahuns = $query->paginate($perPage);

        return TahunSakipResource::collection($tahuns);
    }

    /**
     * Display the specified tahun.
     */
    public function show($id)
    {
        $tahun = TahunSakip::with('periode')->findOrFail($id);

        return new TahunSakipResource($tahun);
    }
}
