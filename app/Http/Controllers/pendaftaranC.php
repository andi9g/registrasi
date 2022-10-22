<?php

namespace App\Http\Controllers;

use App\Models\pertandinganM;
use App\Models\kelasM;
use App\Models\bagianM;
use App\Models\pesertaM;
use App\Models\lombaM;
use Illuminate\Http\Request;

class pendaftaranC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try{
            $idpeserta = $request->session()->get('id');
            $peserta = pesertaM::where('idpeserta', $idpeserta)->first();
            $idbagian = $peserta->jk;
            $kelas = kelasM::get();

            $lomba = lombaM::where('ket', true)->first();
            $perlombaan = lombaM::where('ket', true)->get();

            $pertandingan = pertandinganM::join('peserta', 'peserta.idpeserta', '=', 'pertandingan.idpeserta')
            ->join('kelas', 'kelas.idkelas', 'pertandingan.idkelas')
            ->join('bagian', 'bagian.idbagian', 'pertandingan.idbagian')
            ->join('lomba', 'lomba.idlomba', 'pertandingan.idlomba')
            ->where('peserta.idpeserta', $idpeserta)
            ->where('lomba.ket', true)
            ->orderBy('pertandingan.created_at', 'asc')
            ->select('peserta.*','pertandingan.*', 'kelas.namakelas', 'bagian.namabagian', 'lomba.namalomba', 'lomba.tanggallomba')
            ->get();

            $jumlahdaftar = pertandinganM::where('idpeserta', $idpeserta)->where('sah', false)->count();
            $namabagian = bagianM::where('idbagian', $idbagian)->first()->namabagian;
            return view('pages.pagesPendaftaran', [
                'kelas' => $kelas,
                'pertandingan' => $pertandingan,
                'namabagian' => $namabagian,
                'jumlahdaftar' => $jumlahdaftar,
                'lomba' => $lomba,
                'perlombaan' => $perlombaan,
            ]);

        }catch(\Throwable $th){
            return redirect('identitas')->with('toast_error', 'Lengkapi identitas');
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
        $idpeserta = $request->session()->get('id');

        $request->validate([
            'idkelas' => 'required',
            'lomba' => 'required',
        ]);
        
        
        try{
            $peserta = pesertaM::where('idpeserta', $idpeserta)->first();
            $idbagian = $peserta->jk;
            $idkelas = $request->idkelas;
            $idlomba = $request->lomba;

            
            $cek = lombaM::where('idlomba', $idlomba)->first();
            $akses1 = strtolower($cek->akses);
            $akses2 = strtolower($peserta->kontingen);
            if(!empty($akses1)) {
                if($akses1 != $akses2) {
                    return redirect()->back()->with('warning', 'Maaf jenis lomba hanya untuk kontingen <b>'. strtoupper($akses1)."</b>")->withInput();
                }
            }

            $cek = pertandinganM::where('idkelas', $idkelas)
            ->where('idpeserta', $idpeserta)
            ->where('idlomba', $idlomba)
            ->count();
            if($cek > 0) {
                return redirect()->back()->with('warning', 'Anda telah terdaftar pada pertandingan yang sama')->withInput();
            }


            $store = new pertandinganM;
            $store->idpeserta = $idpeserta;
            $store->idkelas = $idkelas;
            $store->idbagian = $idbagian;
            $store->idlomba = $idlomba;
            $store->sah = false;
            $store->save();

            if($store) {
                return redirect('pendaftaran')->with('toast_success', 'success');
            }
        }catch(\Throwable $th){
            return redirect('pendaftaran')->with('toast_error', 'Terjadi kesalahan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pertandinganM  $pertandinganM
     * @return \Illuminate\Http\Response
     */
    public function show(pertandinganM $pertandinganM)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pertandinganM  $pertandinganM
     * @return \Illuminate\Http\Response
     */
    public function edit(pertandinganM $pertandinganM)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\pertandinganM  $pertandinganM
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, pertandinganM $pertandinganM)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pertandinganM  $pertandinganM
     * @return \Illuminate\Http\Response
     */
    public function destroy(pertandinganM $pertandinganM, $idpertandingan, Request $request)
    {
        try{
            $idpeserta = $request->session()->get('id');

            $cek = pertandinganM::where('idpertandingan', $idpertandingan)
            ->where('idpeserta', $idpeserta)->where('sah', true)->count();

            if ($cek == 1) {
                return redirect()->back()->with('warning', 'Gagal menghapus, pertandingan telah terferifikasi')->withInput();
            }

            $destroy = pertandinganM::where('idpertandingan', $idpertandingan)
            ->where('idpeserta', $idpeserta)->delete();
            
            if($destroy) {
                return redirect('pendaftaran')->with('toast_success', 'success');
            }else {
                return redirect('pendaftaran')->with('toast_error', 'Terjadi kesalahan');
            }
        }catch(\Throwable $th){
            return redirect('pendaftaran')->with('toast_error', 'Terjadi kesalahan');
        }
    }
}
