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
        return NoticiaTipo::where('id_jornalista', auth()->user()->id)->get();
    }

    // Cadastra um novo tipo de noticia
    public function store(StoreNoticiaTipoRequest $request)
    {
        $noticiaTipoData = $request->validated();
        $noticiaTipoData['id_jornalista'] = auth()->user()->id;
        if(NoticiaTipo::create($noticiaTipoData))
            return response()->json(['message' => 'Tipo de noticia cadastrada com sucesso', 'type' => 'success'], 200);

        // Erro geral
         return response()->json(['message' => 'Erro ao cadastrar o tipo de noticia', 'type' => 'error'], 400);
    }

    // Atualiza o tipo de noticia
    public function update(UpdateNoticiaTipoRequest $request, $id)
    {
        $noticiaTipo = NoticiaTipo::find($id);

        if(!$noticiaTipo)
            return response()->json(['message' => 'Tipo de noticia não encontrada.', 'type' => 'error'], 400);

        $noticiaTipoData = $request->validated();

        if($noticiaTipo->id_jornalista  != auth()->user()->id)
            return response()->json(['message' => 'Você não possui permissão para editar um tipo de noticia que não é seu.', 'type' => 'error'], 400);

        if($noticiaTipo->update($noticiaTipoData))
            return response()->json(['message' => 'Tipo de noticia atualizada com sucesso', 'type' => 'success'], 200);

        // Erro geral
        return response()->json(['message' => 'Erro ao atualizar o tipo de noticia', 'type' => 'error'], 400);
    }

    // Deleta o tipo de noticia
    public function destroy($id)
    {
        $noticiaTipo = NoticiaTipo::find($id);
        if(!$noticiaTipo)
            return response()->json(['message' => 'Tipo de noticia não encontrada.', 'type' => 'error'], 400);

        if($noticiaTipo['id_jornalista'] != auth()->user()->id)
            return response()->json(['message' => 'Você não possui permissão para deletar um tipo de noticia que não é seu.', 'type' => 'error'], 400);

        if($noticiaTipo->delete())
            return response()->json(['message' => 'Tipo de noticia deletada com sucesso.', 'type' => 'success'], 200);

        // Erro geral
        return response()->json(['message' => 'Erro ao deletar o tipo de noticia.', 'type' => 'error'], 400);
    }
}
