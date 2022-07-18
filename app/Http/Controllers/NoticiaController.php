<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNoticiaRequest;
use App\Http\Requests\UpdateNoticiaRequest;
use App\Models\Noticia;
use App\Models\NoticiaTipo;

class NoticiaController extends Controller
{
    // Exibe os tipos de noticia por jornalista logado
    public function show()
    {
        return Noticia::where('id_jornalista', auth()->user()->id)->get();
    }

    // Cadastra um novo tipo de noticia
    public function store(StoreNoticiaRequest $request)
    {
        $noticiaData = $request->validated();

        $tiposCadastrados = NoticiaTipo::where('id', $noticiaData['id_tipo_noticia'])->where('id_jornalista', auth()->user()->id)->get();
        if(count($tiposCadastrados) < 1)
            return response()->json(['message' => 'Este tipo de noticia não existe ou não pertece a você.', 'type' => 'success'], 200);

        $noticiaData['id_jornalista'] = auth()->user()->id;
        if(Noticia::create($noticiaData))
            return response()->json(['message' => 'Noticia cadastrada com sucesso', 'type' => 'success'], 200);

        // Erro geral
         return response()->json(['message' => 'Erro ao cadastrar a noticia', 'type' => 'error'], 400);
    }

    // Atualiza o tipo de noticia
    public function update(UpdateNoticiaRequest $request, $id)
    {
        $noticia = Noticia::find($id);
        $noticiaData = $request->validated();

        $tiposCadastrados = NoticiaTipo::where('id', $noticiaData['id_tipo_noticia'])->where('id_jornalista', auth()->user()->id)->get();
        if(count($tiposCadastrados) < 1)
            return response()->json(['message' => 'Este tipo de noticia não existe ou não pertece a você.', 'type' => 'success'], 200);

        if(!$noticia)
            return response()->json(['message' => 'Tipo de noticia não encontrada.', 'type' => 'error'], 400);

        if($noticia->id_jornalista != auth()->user()->id)
            return response()->json(['message' => 'Você não possui permissão para editar um tipo de noticia que não é seu.', 'type' => 'error'], 400);

        if($noticia->id_jornalista != auth()->user()->id)
            return response()->json(['message' => 'Você não possui permissão para editar uma noticia que não é sua.', 'type' => 'error'], 400);

        if($noticia->update($noticiaData))
            return response()->json(['message' => 'Noticia atualizada com sucesso', 'type' => 'success'], 200);

        // Erro geral
        return response()->json(['message' => 'Erro ao atualizar a noticia', 'type' => 'error'], 400);
    }

    // Deleta o tipo de noticia
    public function destroy($id)
    {
        $noticia = Noticia::find($id);
        if(!$noticia)
            return response()->json(['message' => 'Noticia não encontrada.', 'type' => 'error'], 400);

        if($noticia['id_jornalista'] != auth()->user()->id)
            return response()->json(['message' => 'Você não possui permissão para deletar uma noticia que não é sua.', 'type' => 'error'], 400);

        if($noticia->delete())
            return response()->json(['message' => 'Noticia deletada com sucesso.', 'type' => 'success'], 200);

        // Erro geral
        return response()->json(['message' => 'Erro ao deletar a noticia.', 'type' => 'error'], 400);
    }
}
