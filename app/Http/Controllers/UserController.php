<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function create()
    {
        $users = User::withCount('indicados')
            ->having('indicados_count', '<', 2)
            ->get();

        return view('users.create', [
            'users' => $users
        ]);
    }

    public function store(Request $request)
    {
        $data = $request['user'];

        $existeEmail = User::where('email', $data['email'])->exists();

        if($existeEmail){
            return response()->json(['message' => 'Este email já está em uso!'], 400);
        }

        $user = new User();
        $user->fill($data);

        if(isset($data['indication'])){
            $indication = User::find($data['indication']);

            if(count($indication->indicados) > 1){
                return response()->json(['message' => 'Este usuário da indicação já foi muito indicado!'], 400);
            }
            if(!$indication){
                return response()->json(['message' => 'Usuário da indicação não encontrado!'], 400);
            }

            if(empty($indication->point)){
                if(count($indication->indicados) == 1){
                    $user->point = (float)400;
                }else{
                    $user->point = (float)600;
                }
            }else{
                if(count($indication->indicados) == 1){
                    $user->point = $indication->point * (40 / 100);
                }else{
                    $user->point = $indication->point * (60 / 100);
                }
            }

            $user->indication = $data['indication'];
        }

        $user->save();

        return response()->json(['message' => 'Usuário cadastrado com sucesso!'], 201);
    }
    
    public function login()
    {
        return view('users.login');
    }

    public function auth(Request $request) {

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            return redirect('/users/' . auth()->user()->id . '/show');
        }
    
        return back()->withErrors([
            'login' => 'Erro ao realizar o login.',
        ])->onlyInput('login');
    }

    public function show($id)
    {
        if($id != auth()->user()->id){
            abort(404);
        }

        $indicados = User::find($id)->indicados;

        $direito = 0.0;
        $esquerdo = 0.0;
        $users = [];

        foreach ($indicados as $key => $indicado) {
            if ($key == 0) {
                $esquerdo += $this->somaPontos($indicado, 'esquerdo', $users);
            } elseif ($key == 1) {
                $direito += $this->somaPontos($indicado, 'direito', $users);
            }
        }

        return view('users.show', [
            'esquerdo' =>$esquerdo,
            'direito' => $direito,
            'users' => $users
        ]);
    }

    private function somaPontos($user, $lado, &$users)
    {
        $pontos = $user->point;
        $user->lado = $lado;
        $users[] = $user;

        if ($user->indicados && $user->indicados->count() > 0) {

            foreach ($user->indicados as $indicado) {

                $pontos += $this->somaPontos($indicado, $lado, $users);
            }
        }

        return $pontos;
    }

    public function logout(Request $request)
    {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/');
    }
}
