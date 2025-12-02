<?php

namespace App\Http\Controllers\Visitante;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\News;
use App\Models\Place;
use Illuminate\Http\Request;

class VisitorHomeController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->input('q');

        $recentItems = Item::query()
            ->when($q, function ($query, $q) {
                $query->where('name', 'LIKE', "%{$q}%")
                    ->orWhere('description', 'LIKE', "%{$q}%");
            })
            ->latest()
            ->take(4)
            ->get();
        
        $noticiasRecentes = News::latest()->take(3)->get();
        return view('visitante.home', compact('recentItems', 'noticiasRecentes'));
    }


    public function individualItem($id)
    {
        $item = Item::with(['type', 'place'])->findOrFail($id);

        return view('visitante.individual', compact('item'));
    }

    public function allItems(Request $request)
    {
        $q = $request->input('q');

        $allItems = Item::query()
            ->when($q, function ($query, $q) {
                $query->where('name', 'LIKE', "%{$q}%")
                    ->orWhere('description', 'LIKE', "%{$q}%");
            })
            ->get();

        return view('visitante.todos', compact('allItems'));
    }

    public function noticias()
    {
        $noticias = News::all();
        return view('visitante.noticias', compact('noticias'));
    }

    public function lugares()
    {
        $places = Place::all();
        return view('visitante.lugares', compact('places'));
    }

}
