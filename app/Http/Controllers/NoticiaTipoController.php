<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNoticiaTipoRequest;
use App\Http\Requests\UpdateNoticiaTipoRequest;
use App\Models\NoticiaTipo;

class NoticiaTipoController extends Controller
{
    // Exibe os tipos de noticia por jornalista logado
    public function show()
    {
        // TODO: Mudar de 1 para usuário logado
        return NoticiaTipo::where('id_jornalista', 1)->get();
    }

    // Cadastra um novo tipo de noticia
    public function store(StoreNoticiaTipoRequest $request)
    {
        if(NoticiaTipo::create($request->validated()))
            return response()->json(['message' => 'Tipo de noticia cadastrada com sucesso', 'type' => 'success'], 200);

        // Erro geral
         return response()->json(['message' => 'Erro ao cadastrar o tipo de noticia', 'type' => 'error'], 400);
    }

    // Atualiza o tipo de noticia
    public function update(UpdateNoticiaTipoRequest $request, $noticiaTipo)
    {
        // TODO: Mudar de 1 para usuário logado
        $noticiaTipoData = $request->validated();
        if($noticiaTipoData['id_jornalista'] != 1)
            return response()->json(['message' => 'Você não possui permissão para editar um tipo de noticia que não é seu.', 'type' => 'error'], 400);

        if(NoticiaTipo::find($noticiaTipo)->update($noticiaTipoData))
            return response()->json(['message' => 'Tipo de noticia atualizada com sucesso', 'type' => 'success'], 200);

        // Erro geral
        return response()->json(['message' => 'Erro ao atualizar o tipo de noticia', 'type' => 'error'], 400);
    }

    // Deleta o tipo de noticia
    public function destroy($noticiaTipo)
    {
        // TODO: Mudar de 1 para usuário logado
        // if($noticiaTipo != 1)
        //    return response()->json(['message' => 'Você não possui permissão para deletar um tipo de noticia que não é seu.', 'type' => 'error'], 400);

        if(NoticiaTipo::find($noticiaTipo)->delete())
            return response()->json(['message' => 'Tipo de noticia deletada com sucesso.', 'type' => 'success'], 200);

        // Erro geral
        return response()->json(['message' => 'Erro ao deletar o tipo de noticia.', 'type' => 'error'], 400);
    }
}
