<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJornalistaRequest;
use App\Models\Jornalista;
use App\Services\Auth\LoginService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class JornalistaController extends Controller
{

    private $loginService;

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        try
        {
            $credentials = $request->only('email', 'password');
            $auth = $this->loginService->execute($credentials);
            return response()->json([$auth], 200);
        } catch (\Exception $e)
        {
            return response()->json(['message' => 'Erro ao realizar login', 'exception' => $e, 'type' => 'error'], 400);
        }
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user(), 200);
    }

    // Exibe os dados do jornalista
    public function index()
    {
        return Jornalista::all();
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
