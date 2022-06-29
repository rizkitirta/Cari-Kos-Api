<?php

namespace App\Http\Controllers;

use App\Http\Resources\KosResource;
use App\Models\Fasilitas;
use App\Models\Kategori;
use App\Models\KategoriKos;
use App\Models\KontenFasilitas;
use App\Models\KontenPeraturanKos;
use App\Models\Kos;
use App\Models\PeraturanKos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Traits\ResponseTrait;
use Illuminate\Support\Facades\DB;

class KosController extends Controller
{
    use ResponseTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perPage = $request->get('perPage') ?? 10;
        try {
            $data = Kos::with(['user:id,name', 'kecamatan:id,name', 'kategori:id,nama', 'fasilitas.konten'])
                ->withCount('kamar')
                ->FilterKategori($request)
                ->FilterLokasi($request)
                ->simplePaginate($perPage)
                ->map(function ($d) {
                    return [
                        'id' => $d->id,
                        'nama' => $d->nama,
                        'pemilik_kos' => $d->user->name,
                        'sisa_kamar' => $d->kamar_count,
                        'lokasi' => [
                            'id' => $d->kecamatan->id,
                            'name' => $d->kecamatan->name,
                        ],
                        'kategori' => $d->kategori->map(function ($ktg) {
                            return ['id' => $ktg->id, 'nama' => $ktg->nama];
                        }),
                        'fasilitas' => $d->fasilitas->map(function ($fsl) {
                            $arr = [];
                            foreach ($fsl->konten as $ktn) {
                                $arr[] = [
                                    'id' => $ktn->id,
                                    'konten' => $ktn->konten,
                                ];
                            }

                            return $arr;
                        })[0]
                    ];
                });

            // dd($data->toArray());
            return $this->SuccessResponse("Berhasil mengambil data", $data);
        } catch (\Exception $e) {
            Log::error($e->getMessage(), [request()->user()]);
            return $this->ErrorResponse("Gagal mengambil data", 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            // dd($request->all());
            DB::beginTransaction();
            $kos = new Kos;
            $kos->user_id = $request->user()->id;
            $kos->nama = $request->nama;
            $kos->deskripsi = $request->deskripsi;
            $kos->lintang = $request->lintang;
            $kos->bujur = $request->bujur;
            $kos->provinsi_id = $request->provinsi_id;
            $kos->kabkota_id = $request->kabkota_id;
            $kos->kecamatan_id = $request->kecamatan_id;
            $kos->alamat = $request->alamat;
            $kos->uang_muka = $request->uang_muka;
            $kos->persentase_uang_muka = $request->persentase_uang_muka;
            $kos->tipe_pembayaran = $request->tipe_pembayaran;
            $kos->logo = $request->logo;
            $kos->cover = $request->cover;
            $kos->save();

            // insert kategori
            foreach ($request->kategori as $ktg) {
                $kategori = Kategori::find($ktg);
                $kos->kategori()->attach($kategori);
            }

            // insert fasilitas
            $fasilitasKos = new Fasilitas();
            $fasilitasKos->judul = Fasilitas::TIPE['kos'];
            $fasilitasKos->fasilitastable_id = $kos->id;
            $fasilitasKos->fasilitastable_type = Kos::class;
            $fasilitasKos->save();

            foreach ($request->fasilitas_kos as $item) {
                KontenFasilitas::create(['fasilitas_id' => $fasilitasKos->id, 'konten' => $item]);
            }

            // insert peraturan kos
            $peraturanKos = new PeraturanKos();
            $peraturanKos->kos_id = $kos->id;
            $peraturanKos->judul = PeraturanKos::JUDUL;
            $peraturanKos->save();

            foreach ($request->peraturan_kos as $kontenPeraturan) {
                KontenPeraturanKos::create(['peraturan_kos_id' => $peraturanKos->id, 'konten' => $kontenPeraturan]);
            }

            DB::commit();

            return $this->SuccessResponse("Berhasil membuat data", $kos);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage(), [request()->user()]);
            return $this->ErrorResponse("Ups Terjadi kesalahan!", $e->getCode());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\kos  $kos
     * @return \Illuminate\Http\Response
     */
    public function show(kos $kos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\kos  $kos
     * @return \Illuminate\Http\Response
     */
    public function edit(kos $kos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\kos  $kos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, kos $kos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\kos  $kos
     * @return \Illuminate\Http\Response
     */
    public function destroy(kos $kos)
    {
        //
    }
}
