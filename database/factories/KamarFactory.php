<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class KamarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $char = ['A','B','C','D'];
        return [
            'kos_id' => rand(1,1000),
            'nama' => $this->faker->firstName(),
            'tipe_kamar' => $char[rand(0,3)],
            'harga' => rand(300000,2000000),
            'max_orang' => rand(1,4),
            'deskripsi' => $this->faker->paragraph()
        ];
    }
}
