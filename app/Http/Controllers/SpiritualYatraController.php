<?php

namespace App\Http\Controllers;

use App\Models\SpiritualYatra;
use Illuminate\Http\Request;

class SpiritualYatraController extends Controller
{
    public function index()
    {
        $yatras = SpiritualYatra::where('status', true)->latest()->paginate(12);
        return view('spiritual-yatras.index', compact('yatras'));
    }

    public function show($slug)
    {
        $yatra = SpiritualYatra::where('slug', $slug)->where('status', true)->firstOrFail();
        
        $relatedYatras = SpiritualYatra::where('status', true)
            ->where('id', '!=', $yatra->id)
            ->inRandomOrder()
            ->take(3)
            ->get();
            
        return view('spiritual-yatras.show', compact('yatra', 'relatedYatras'));
    }
}
