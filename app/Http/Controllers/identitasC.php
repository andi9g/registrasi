<?php

namespace App\Http\Controllers;

use App\Models\pesertaM;
use App\Models\registrasiM;
use Illuminate\Http\Request;

class identitasC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $id = $request->session()->get('id');
        $identitas = pesertaM::where('idpeserta', $id);
        $namakontingen = "";
        $jk = "";
        $wa = "";
        if($identitas->count() === 1) {
            $namapeserta = $identitas->first()->namapeserta;
            $namakontingen = $identitas->first()->kontingen;
            $jk = $identitas->first()->jk;
            $wa = $identitas->first()->wa;
        }else {
            $namapeserta = registrasiM::where('idregistrasi', $id)->first()->namaregistrasi;
        }

        $kontingen = pesertaM::select('kontingen')->groupBy('kontingen')->get();

        return view('pages.pagesIdentitas',[
            'namapeserta' => $namapeserta,
            'kontingen' => $kontingen,
            'namakontingen' => $namakontingen,
            'jk' => $jk,
            'wa' => $wa,
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
