<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJornalistaRequest;
use App\Models\Jornalista;
use Illuminate\Support\Facades\Hash;

class JornalistaController extends Controller
{
    // Exibe todos os jornalistas
    public function index()
    {
        return Jornalista::all();
    }

    // Exibe os dados do jornalista
    public function show()
    {
        // TODO: Mudar de 1 para usuário logado
        return Jornalista::find(1);
    }

    // Cadastra um novo jornalista
    public function store(StoreJornalistaRequest $request)
    {
        $jornalistaData = $request->validated();
        $jornalistaData['senha'] = Hash::make($request->validated('senha'));
        if(Jornalista::create($jornalistaData))
            return response()->json(['message' => 'Jornalista cadastrado com sucesso', 'type' => 'success'], 200);

        // Erro geral
         return response()->json(['message' => 'Erro ao cadastrar o jornalista', 'type' => 'error'], 400);
    }
}
