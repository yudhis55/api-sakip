<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OpdResource;
use App\Models\Opd;
use Illuminate\Http\Request;

class OpdController extends Controller
{
    /**
     * Display a listing of OPD.
     */
    public function index(Request $request)
    {
        $query = Opd::query();

        // Search by name
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Pagination
        $perPage = $request->get('per_page', 15);

        if ($request->boolean('all', false)) {
            $opds = $query->get();
            return OpdResource::collection($opds);
        }

        $opds = $query->paginate($perPage);

        return OpdResource::collection($opds);
    }

    /**
     * Display the specified OPD.
     */
    public function show($id)
    {
        $opd = Opd::findOrFail($id);

        return new OpdResource($opd);
    }
}
