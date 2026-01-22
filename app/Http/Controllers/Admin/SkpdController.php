<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skpd;
use Illuminate\Http\Request;

class SkpdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $skpd = Skpd::all();
        return view('admin.skpd.index', compact('skpd'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.skpd.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Skpd $skpd)
    {
        return view('admin.skpd.show', compact('skpd'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Skpd $skpd)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Skpd $skpd)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Skpd $skpd)
    {
        //
    }
}
