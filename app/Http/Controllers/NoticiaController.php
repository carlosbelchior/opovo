<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNoticiaRequest;
use App\Http\Requests\UpdateNoticiaRequest;
use App\Models\Noticia;

class NoticiaController extends Controller
{
    // Exibe os tipos de noticia por jornalista logado
    public function show()
    {
        // TODO: Mudar de 1 para usuário logado
        return Noticia::where('id_jornalista', 1)->get();
    }

    // Cadastra um novo tipo de noticia
    public function store(StoreNoticiaRequest $request)
    {
        $noticiaData = $request->validated();
        $noticiaData['id_jornalista'] = 1;
        if(Noticia::create($noticiaData))
            return response()->json(['message' => 'Noticia cadastrada com sucesso', 'type' => 'success'], 200);

        // Erro geral
         return response()->json(['message' => 'Erro ao cadastrar a noticia', 'type' => 'error'], 400);
    }

    // Atualiza o tipo de noticia
    public function update(UpdateNoticiaRequest $request, $noticiaTipo)
    {

        $noticiaData = $request->validated();

        // TODO: Mudar de 1 para usuário logado
        $noticiaData['id_jornalista'] = 1;

        if($noticiaData['id_jornalista'] != 1)
            return response()->json(['message' => 'Você não possui permissão para editar uma noticia que não é sua.', 'type' => 'error'], 400);

        if(Noticia::find($noticiaTipo)->update($noticiaData))
            return response()->json(['message' => 'Noticia atualizada com sucesso', 'type' => 'success'], 200);

        // Erro geral
        return response()->json(['message' => 'Erro ao atualizar a noticia', 'type' => 'error'], 400);
    }

    // Deleta o tipo de noticia
    public function destroy($noticiaTipo)
    {
        // TODO: Mudar de 1 para usuário logado
        // if($noticiaTipo != 1)
        //    return response()->json(['message' => 'Você não possui permissão para deletar um tipo de noticia que não é seu.', 'type' => 'error'], 400);

        if(Noticia::find($noticiaTipo)->delete())
            return response()->json(['message' => 'Noticia deletada com sucesso.', 'type' => 'success'], 200);

        // Erro geral
        return response()->json(['message' => 'Erro ao deletar a noticia.', 'type' => 'error'], 400);
    }
}
