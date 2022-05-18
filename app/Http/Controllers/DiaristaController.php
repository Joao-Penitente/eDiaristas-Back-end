<?php

namespace App\Http\Controllers;

use App\Http\Requests\DiaristaRequest;
use App\Models\Diarista;
use App\Services\ViaCEP;
use Illuminate\Http\Request;

class DiaristaController extends Controller
{

    public function __construct(protected ViaCEP $viaCep)
    {}
    /**
     * Lista as Diarista
     */
    public function index(){
        $diaristas = Diarista::get();

        return view('index', compact('diaristas'));
    }

    /**
     * Mostra o formulário de Criação
     */
    public function create(){

        return view('create');
    }

    /**
     * Cria uma diarista no banco de dados
     */
    public function store(DiaristaRequest $request){
        $dados = $request->except('_token');
        $dados['foto_usuario'] = $request->foto_usuario->store('public');

        $dados['cpf'] = str_replace(['.', '-'], '',$dados['cpf']);
        $dados['cep'] = str_replace('-', '', $dados['cep']);
        $dados['telefone'] = str_replace(['(', ')', ' ', '-'], '', $dados['telefone']);
        $dados['codigo_ibge'] = $this->viaCep->buscar($dados['cep'])['ibge'];

        Diarista::create($dados);
        return redirect()->route('diaristas.index')->with('success, Diarista criada com sucesso');
    }
    /**
     * Mostra o Formulario de Edição populado
     */
    public function edit($id){
        $diarista = Diarista::findOrFail($id);
        return view('edit', compact('diarista'));
    }

    /**
     * Atualiza uma diarista no banco de dados
     */
    public function update(DiaristaRequest $request, $id){
        $diarista = Diarista::findOrFail($id);
        $dados = $request->except(['_token', '_method']);

        $dados['cpf'] = str_replace(['.', '-'], '', $dados['cpf']);
        $dados['cep'] = str_replace('-', '', $dados['cep']);
        $dados['telefone'] = str_replace(['(', ')', ' ', '-'], '', $dados['telefone']);
        $dados['codigo_ibge'] = $this->viaCep->buscar($dados['cep'])['ibge'];

        if($request->hasFile('foto_usuario')){
            $dados['foto_usuario'] = $request->foto_usuario->store('public');
        }

        $diarista->update($dados);
        return redirect()->route('diaristas.index')->with('success, Diarista atualizada com sucesso');
    }
    /**
     * Apaga uma diarista do  bando de dados
     */
    public function destroy($id){
        $diarista = Diarista::findOrFail($id);
        $diarista->delete();

        return redirect()->route('diaristas.index');
    }
}