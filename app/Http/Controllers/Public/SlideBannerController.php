<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\SlideBanner;
use Illuminate\Http\JsonResponse;

class SlideBannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $slides = SlideBanner::orderBy('order', 'asc')->get();

        return response()->json([
            'success' => true,
            'data'    => $slides
        ], 200);
    }
}