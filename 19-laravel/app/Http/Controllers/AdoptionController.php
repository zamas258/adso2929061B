<?php

namespace App\Http\Controllers;

use App\Models\Adoption;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AdoptionsExport;

class AdoptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $adopts = Adoption::with(['user', 'pet'])->latest()->get();
        return view('adoptions.index', compact('adopts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(Adoption $adoption)
    {
        $adopt = Adoption::with(['user', 'pet'])->findOrFail($adoption->id);
        return view('adoptions.show', compact('adopt'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Adoption $adoption)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Adoption $adoption)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Adoption $adoption)
    {
        //
    }

    public function pdf()
    {
        $adopts = Adoption::with(['user', 'pet'])->latest()->get();
        $pdf = Pdf::loadView('adoptions.pdf', compact('adopts'));
        return $pdf->download('adoptions-' . date('Y-m-d') . '.pdf');
    }

    public function excel()
    {
        return Excel::download(new AdoptionsExport, 'adoptions-' . date('Y-m-d') . '.xlsx');
    }
}
