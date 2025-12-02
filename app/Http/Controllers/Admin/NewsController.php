<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $noticias = News::all();
        return view('admin.noticia.noticias', compact('noticias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'required|string',
        ]);

        News::create([
            'user_id' => auth()->id(),
            'title' => $request->titulo,
            'description' => $request->descricao,
            'date' => now()->format('Y-m-d'),
            'status' => 1,
        ]);

        return redirect()->route('admin.noticias')->with('success', 'Notícia criada com sucesso!');
    }

    public function destroy($id)
    {
        News::findOrFail($id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Notícia excluída com sucesso!'
        ]);
    }
}
