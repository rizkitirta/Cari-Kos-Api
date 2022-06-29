<?php

namespace Tests\Feature\kos;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ManagekosTest extends TestCase
{
    use DatabaseTransactions;

    protected $url = 'http://localhost:8000/api/v1/kos';
    /**
     * Authenticate user.
     *
     * @return void
     */
    protected function authenticate()
    {
        $user = User::create([
            'name' => 'test',
            'email' => rand(12345, 678910) . 'test@gmail.com',
            'password' => \Hash::make('secret9874'),
        ]);

        return $user->createToken('ApiToken')->plainTextToken;;
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_store_kos()
    {
        $token = $this->authenticate();
        $data = [
            "nama" => "Kos Mami Putri",
            "deskripsi" => "kos murah dan bersih",
            "lintang" => "-6.267607554842836",
            "bujur" => "106.80919489804413",
            "provinsi_id" => 31,
            "kabkota_id" => 3174,
            "kecamatan_id" => 1978,
            "alamat" => "Cilandak",
            "logo" => "https=>//picsum.photos/250/250",
            "cover" => "https=>//picsum.photos/1080/720",
            "uang_muka" => true,
            "persentase_uang_muka" => 10,
            "tipe_pembayaran" => 1,
            "kategori" => [1, 2],
            "fasilitas_kos" => [
                "Wifi", "Parkir", "Ruang Tamu Bersama"
            ],
            "peraturan_kos" => [
                "Tidak boleh membawa sajam",
                "Tidak boleh membawa narkoba",
                "Tamu menginap dikenakan biaya"
            ]
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->json('POST', $this->url, $data);

        $response->assertStatus(200);
    }

    public function test_show_kos()
    {
        $token = $this->authenticate();

        $url = $this->url . "/2";
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $token,
        ])->json('GET',$url);

        $response->assertStatus(200);
    }
}
