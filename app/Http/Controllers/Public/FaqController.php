<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FaqController extends Controller
{
    /**
     * Menampilkan daftar FAQ.
     */
    public function index(Request $request): JsonResponse
    {
        $query = Faq::query();

        return response()->json(['data' => $query->orderBy('created_at', 'desc')->paginate(10)]);
    }
}