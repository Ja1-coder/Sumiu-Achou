<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\ItemType;
use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::with(['type', 'place'])
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        // Aplica o map APÓS o paginate
        $items->getCollection()->transform(function ($item) {
            $item->status_text = Item::STATUS[$item->status] ?? 'Desconhecido';
            return $item;
        });
        return view('admin.item.listar-item', compact('items'));
    }

    public function showListItem()
    {
        $places = Auth::user()->places()->orderBy('full_address')->get();

        $types = ItemType::orderBy('name')->get();
        return view('admin.item.cadastrar-item', compact('places', 'types'));
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'name'        => 'required|string|max:255',
            'type_id'     => 'required|exists:item_types,id',
            'place_id'    => 'required|exists:places,id',
            'description' => 'required|string',
            'picture'     => 'required|image|max:2048',
        ], [
            'name.required'        => 'O campo Nome é obrigatório.',
            'type_id.required'     => 'O campo Tipo é obrigatório.',
            'place_id.required'    => 'O campo Local é obrigatório.',
            'description.required' => 'O campo Descrição é obrigatório.',
            'picture.required'     => 'O campo Imagem é obrigatório.',
        ]);

        // Upload da imagem
        $picturePath = $request->file('picture')->store('items', 'public');

        Item::create([
            'name' => $request->name,
            'type_id' => $request->type_id,
            'place_id' => $request->place_id,
            'user_id' => Auth::id(),
            'description' => $request->description,
            'picture' => $picturePath,
            'status' => Item::STATUS_STORED, // sempre começa armazenado
        ]);

        return redirect()->route('admin.listar-item')
            ->with('success', 'Item cadastrado com sucesso!');
    }

    public function devolver(Request $request, $id)
    {
        $item = Item::findOrFail($id);

        $request->validate([
            'registration' => 'required|string|max:20'
        ]);

        $item->update([
            'status' => Item::STATUS_RETURNED,
            'enrollment' => $request->registration,
            'delivery_date' => now()->format('Y-m-d'),
        ]);

        return back()->with('success', 'Item devolvido com sucesso!');
    }

    public function reportar(Request $request, $id)
    {
        $item = Item::findOrFail($id);

        $request->validate([
            'email' => 'required|email'
        ]);

        $item->update([
            'status' => Item::STATUS_REPORTED,
            'report_contact_email' => $request->email
        ]);

        return back()->with('success', 'Item reportado com sucesso!');
    }

}
