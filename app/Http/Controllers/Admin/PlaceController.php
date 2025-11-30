<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Place;
use App\Models\User;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    public function index()
    {
        $places = Place::with(['users', 'items'])->get();
        return view('admin.lugar.listar-lugares', compact('places'));
    }

    public function showCreatePlace()
    {
        $supervisores = User::where('type', User::TYPE_SUPERVISOR)->get();
        return view('admin.lugar.cadastrar-lugar', compact('supervisores'));
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $validated = $request->validate([
            'full_address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:50',
            'operating_hours' => 'nullable|string',
            'users.*' => 'exists:users,id'
        ], [
            'full_address.required' => 'O endereço completo é obrigatório.',
            'full_address.max' => 'O endereço não pode ultrapassar 255 caracteres.',

            'phone.required' => 'O telefone é obrigatório.',
            'phone.max' => 'O telefone não pode ter mais de 20 caracteres.',

            'email.required' => 'O e-mail é obrigatório.',
            'email.email' => 'O formato do e-mail é inválido.',
            'email.max' => 'O e-mail não pode ultrapassar 50 caracteres.',

            'operating_hours.string' => 'O campo horário de funcionamento deve ser um texto válido.',

            'users.*.exists' => 'Um ou mais usuários informados não existem.',
        ]);

        $place = Place::create($validated);

        if (!empty($validated['users'])) {
            $place->users()->sync($validated['users']);
        }

        return redirect()
            ->route('admin.listar-lugares')
            ->with('success', 'Ponto de coleta cadastrado com sucesso!');
    }

    public function edit($id)
    {
        $place = Place::with('users')->findOrFail($id);

        $supervisores = User::where('type', User::TYPE_SUPERVISOR)->get();

        return view('admin.lugar.editar-lugar', [
            'place' => $place,
            'supervisores' => $supervisores,
        ]);
    }

    public function update(Request $request, $id)
    {
        //dd($request->all());
        $validated = $request->validate([
            'full_address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:50',
            'operating_hours' => 'nullable|string',
            'users.*' => 'exists:users,id'
        ], [
            'full_address.required' => 'O endereço completo é obrigatório.',
            'full_address.max' => 'O endereço não pode ultrapassar 255 caracteres.',

            'phone.required' => 'O telefone é obrigatório.',
            'phone.max' => 'O telefone não pode ter mais de 20 caracteres.',

            'email.required' => 'O e-mail é obrigatório.',
            'email.email' => 'O formato do e-mail é inválido.',
            'email.max' => 'O e-mail não pode ultrapassar 50 caracteres.',

            'operating_hours.string' => 'O campo horário de funcionamento deve ser um texto válido.',

            'users.*.exists' => 'Um ou mais usuários informados não existem.',
        ]);

        $place = Place::findOrFail($id);

        $place->update($validated);

        // Atualiza supervisores
        $place->users()->sync($validated['users'] ?? []);

        return redirect()
            ->route('admin.listar-lugares')
            ->with('success', 'Ponto de coleta atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $place = Place::findOrFail($id);

        // Verifica se há itens cadastrados
        if ($place->items()->exists()) {
            return redirect()
                ->route('admin.listar-lugares')
                ->withErrors('Não é possível excluir o lugar, pois existem itens cadastrados.');
        }

        // Remove vínculos com usuários
        $place->users()->detach();

        // Exclui o lugar
        $place->delete();

        return redirect()
            ->route('admin.listar-lugares')
            ->with('success', 'Lugar excluído com sucesso!');
    }



}
