<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; 
use Illuminate\Validation\ValidationException; 
use InvalidArgumentException; 

class UserController extends Controller
{
    public function index()
    {
        try{
            $users = User::where('id', '!=', auth()->user()->id)->paginate(5);
            return view('admin.usuario.listar-usuarios', compact('users'));
        } catch(\Exception $e){
            logger()->error($e->getMessage());
            abort(500, $e->getMessage());
        }
       
    }

    public function showCreateUser()
    {
        return view('admin.usuario.cadastrar-usuario');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed', 
            'tipo' => 'required|string|in:administrador,supervisor',
        ]);
        try{
        
            try {
                $userType = User::mapTypeStringToInt($validatedData['tipo']);
            } catch (InvalidArgumentException $e) {
                throw ValidationException::withMessages(['tipo' => 'Tipo de usuário inválido fornecido.']);
            }

            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => $validatedData['password'], 
                'type' => $userType,
            ]);

            return redirect()->route('admin.listar-usuarios')->with('success', 'Usuário ' . $user->name . ' cadastrado com sucesso!');
        } catch(\Exception $e){
            logger()->error($e->getMessage());
            abort(500, $e->getMessage());
        }
        
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('admin.usuario.editar-usuario', compact('user'));
    }

    public function update(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);

            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $id,
                'tipo' => 'required|in:administrador,supervisor',
            ]);

            // Atualização
            $user->name = $request->name;
            $user->email = $request->email;
            $user->type = User::mapTypeStringToInt($validated['tipo']);

            $user->save();

            return redirect()
                ->route('admin.listar-usuarios')
                ->with('success', 'Usuário atualizado com sucesso!');

        } catch (\Exception $e) {
            logger()->error($e->getMessage());
            return back()->withErrors('Erro ao atualizar o usuário.');
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return redirect()
                ->route('admin.listar-usuarios')
                ->with('success', 'Usuário excluído com sucesso!');
        } catch (\Exception $e) {
            logger()->error($e->getMessage());
            return back()->withErrors('Erro ao excluir o usuário.');
        }
    }


}