<?php

namespace App\Http\Controllers;

use App\Models\kos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Traits\ResponseTrait;

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
            $data = kos::with(['user:name','kecamatan:id,name','kategori'])->paginate($perPage);

            return $this->SuccessResponse("Berhasil mengambil data",$data);
        } catch (\Exception $e) {
            Log::error($e->getMessage(),[request()->user()]);
            return $this->ErrorResponse("Gagal mengambil data",500);
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
        //
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
