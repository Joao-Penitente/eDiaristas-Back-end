<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\diarista>
 */
class DiaristaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
        'nome_completo' => $this->faker->name(),
        'cpf' => '11111000000',
        'email' => $this->faker->unique()->safeEmail(),
        'telefone' => '99999999999',
        'logradouro' => '$this->faker->streetName()',
        'numero' => 3,
        'bairro' => '$this->faker->secondaryAddress()',
        'complemento' => '$this->faker->secondaryAddress()',
        'cidade' => 'colatina',
        'cep' => '29933570',
        'estado' => 'es',
        'codigo_ibge' => 3204906,
        'foto_usuario'  => '',
        ];
    }
}
