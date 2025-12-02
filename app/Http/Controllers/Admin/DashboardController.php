<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Se for admin, ele vê tudo
        if ($user->isAdmin()) {
            $items = Item::all();
        } 
        // Se for supervisor, filtra pelos locais permitidos
        else {
            $allowedPlaceIds = $user->places()->pluck('places.id');
            $items = Item::whereIn('place_id', $allowedPlaceIds)->get();
        }

        // Métricas
        $totalItems = $items->count();
        $storedItems = $items->where('status', Item::STATUS_STORED)->count();
        $returnedItems = $items->where('status', Item::STATUS_RETURNED)->count();
        $reportedItems = $items->where('status', Item::STATUS_REPORTED)->count();

        $newThisMonth = $items->where('created_at', '>=', now()->subDays(30))->count();
        $itemsByType = $items->groupBy('type_id')->map->count();

        return view('admin.dashboard', [
            'totalItems'     => $totalItems,
            'storedItems'    => $storedItems,
            'returnedItems'  => $returnedItems,
            'reportedItems'  => $reportedItems,
            'newThisMonth'   => $newThisMonth,
            'itemsByType'    => $itemsByType,
        ]);
    }

}
