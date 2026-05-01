<?php

namespace App\Exports;

use App\Models\Adoption;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AdoptionsExport implements FromView
{
    public function view(): View
    {
        $adopts = Adoption::with(['user', 'pet'])->latest()->get();
        return view('adoptions.excel', compact('adopts'));
    }
}
