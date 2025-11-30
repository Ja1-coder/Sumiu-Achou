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

        // Todos os lugares que ele tem permissão
        $allowedPlaceIds = $user->places()->pluck('places.id');

        // Filtrar itens somente desses lugares
        $items = Item::whereIn('place_id', $allowedPlaceIds)->get();

        // Montar métricas
        $totalItems = $items->count();
        $storedItems = $items->where('status', Item::STATUS_STORED)->count();
        $returnedItems = $items->where('status', Item::STATUS_RETURNED)->count();
        $reportedItems = $items->where('status', Item::STATUS_REPORTED)->count();

        // Itens criados nos últimos 30 dias
        $newThisMonth = $items->where('created_at', '>=', now()->subDays(30))->count();

        // Contagem por tipo
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
