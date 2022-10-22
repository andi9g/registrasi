<?php

namespace App\Http\Controllers;

use App\Models\pesertaM;
use App\Models\pertandinganM;
use App\Models\lombaM;
use App\Models\kelasM;
use Illuminate\Http\Request;

class homeC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $idpeserta = $request->session()->get('id');
        $belumterferifikasi = pertandinganM::where('idpeserta', $idpeserta)
        ->where('sah', false)->count();
        $terferifikasi = pertandinganM::where('idpeserta', $idpeserta)
        ->where('sah', true)->count();

        $lomba = lombaM::where('ket', true)->get();

        $kelas = kelasM::get();

        return view('pages.pagesHome', [
            'belumterferifikasi' => $belumterferifikasi,
            'terferifikasi' => $terferifikasi,
            'lomba' => $lomba,
            'kelas' => $kelas,
        ]);
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
     * @param  \App\Models\pesertaM  $pesertaM
     * @return \Illuminate\Http\Response
     */
    public function show(pesertaM $pesertaM)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pesertaM  $pesertaM
     * @return \Illuminate\Http\Response
     */
    public function edit(pesertaM $pesertaM)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\pesertaM  $pesertaM
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, pesertaM $pesertaM)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pesertaM  $pesertaM
     * @return \Illuminate\Http\Response
     */
    public function destroy(pesertaM $pesertaM)
    {
        //
    }
}
