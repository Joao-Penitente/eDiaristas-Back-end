<?php

namespace App\Http\Controllers;

use App\Http\Requests\DiaristaRequest;
use App\Models\Diarista;
use App\Services\ViaCEP;
use Illuminate\Http\Request;

class BuscaDiaristaCep extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(DiaristaRequest $request, ViaCEP $ViaCEP)
    {
        $endereco = $ViaCEP->buscar($request->cep);
        
        if($endereco === false){
            return response()->json(['erro'=>'Cep Inválido'], 400);
        }

        return [
            'diaristas' => Diarista::buscaPorCodigoIbge($endereco['ibge']),
            'quantidade_diaristas' => Diarista::quantidadePorCodigoIbge($endereco['ibge']),
        ];
        //return response()->json($diaristas, 200);

        //entrada codigo do ibge
        //lista de daristas filtrada pelo código
    }
}