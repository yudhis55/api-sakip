<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PeriodeSakipResource;
use App\Models\PeriodeSakip;
use Illuminate\Http\Request;

class PeriodeSakipController extends Controller
{
    /**
     * Display a listing of periode.
     */
    public function index(Request $request)
    {
        $query = PeriodeSakip::query();

        // Filter by tahun range
        if ($request->has('tahun')) {
            $tahun = $request->tahun;
            $query->where('tahun_mulai', '<=', $tahun)
                ->where('tahun_selesai', '>=', $tahun);
        }

        // Pagination
        $perPage = $request->get('per_page', 15);

        if ($request->boolean('all', false)) {
            $periodes = $query->get();
            return PeriodeSakipResource::collection($periodes);
        }

        $periodes = $query->paginate($perPage);

        return PeriodeSakipResource::collection($periodes);
    }

    /**
     * Display the specified periode.
     */
    public function show($id)
    {
        $periode = PeriodeSakip::findOrFail($id);

        return new PeriodeSakipResource($periode);
    }
}
