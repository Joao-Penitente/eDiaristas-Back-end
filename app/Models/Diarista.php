<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diarista extends Model
{
    use HasFactory;

    /**
     * Define os campos que podem ser gravados
     */
    protected $fillable = [
        'nome_completo',
        'cpf',
        'email',
        'telefone',
        'logradouro',
        'numero',
        'bairro',
        'complemento',
        'cidade',
        'cep',
        'estado',
        'codigo_ibge',
        'foto_usuario',
    ];

    /**
     * Define os campos que serão usados na serialização
     */
    protected $visible = [
        'nome_completo',
        'cidade',
        'foto_usuario',
        'reputacao'
    ];
    /**
     * Adiciona campos na serialização
     */
    protected $appends = ['reputacao'];

    /**
     * Monta url da imagem
     */
    public function getFotoUsuarioAttribute(string $valor)
    {
        return config('app.url') . '/' . $valor;
    }
    /**
     * Retorna a reputação randomica
     */
    public function getReputacaoAttribute($valor){
        return mt_rand(1, 5);
    }

    /**
     * Busca diaristas por codigo IBGE
     */
    static public function buscarPorCodigoIbge($codigo){
        return self::where('codigo_ibge', $codigo)->limit(6)->get();
    }

    /**
     * Retorna a quantidade de diaristas
     */
    static public function quantidadePorCodigoIbge(int $codigoIbge)
    {
        $quantidade =  Diarista::where('codigo_ibge', $codigoIbge)->count();

        return $quantidade > 6 ? $quantidade - 6 : 0;
    }

}