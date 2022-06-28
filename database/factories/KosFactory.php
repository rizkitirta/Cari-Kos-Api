<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class KosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => rand(1,1000),
            'kategori_id' => rand(1,2),
            'nama' => $this->faker->firstName(),
            'deskripsi' => $this->faker->paragraph(),
            'lintang' => $this->faker->latitude(),
            'bujur' => $this->faker->longitude(),
            'provinsi_id' => rand(1,34),
            'kabkota_id' => rand(1,100),
            'kecamatan_id' => rand(1,200),
            'alamat' => $this->faker->address(),
            'logo' => $this->faker->imageUrl($width = 640, $height = 480),
            'cover' => $this->faker->imageUrl($width = 640, $height = 480),
            'uang_muka' => true,
            'persentase_uang_muka' => 10,
            'tipe_pembayaran' => 1,
        ];
    }
}
