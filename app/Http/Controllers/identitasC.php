<?php

namespace App\Http\Controllers;

use App\Models\pesertaM;
use App\Models\registrasiM;
use Illuminate\Http\Request;
use Storage;
use Hash;
use File;

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
        $idpeserta = $request->session()->get('id');

        $cek = pesertaM::where('idpeserta', $idpeserta)->count();

        if($cek == 0) {
            $request->validate([
                'gambar'=>'required|mimes:png,jpg,jpeg',
                'nama' => 'required',
                'kontingen' => 'required',
                'jk' => 'required',
                'wa' => 'required',
            ]);
        }else {
            $request->validate([
                'nama' => 'required',
                'kontingen' => 'required',
                'jk' => 'required',
                'wa' => 'required',
            ]);
        }
        
        try{
            $namapeserta = $request->nama;
            $kontingen = strtoupper($request->kontingen);
            $wa = $request->wa;
            $jk = $request->jk;

            if ($request->hasFile('gambar')) {
                $gambar = $request->file('gambar');
                $originName = $gambar->getClientOriginalName();
                $fileName = pathinfo($originName, PATHINFO_FILENAME);
                $extension = $gambar->getClientOriginalExtension();
                $size = $gambar->getSize();
                $format = strtolower($extension);
                if($format == 'jpg' || $format == 'jpeg' || $format == 'png') {
                    //request data
                    
                    $fileName = str_replace(" ","",$fileName).'_'.time().uniqid().'.'.$extension;
                    $kirim = $gambar->move(public_path('/img/peserta'), $fileName);
                    // $kirim = Storage::disk("local")->put("gambar/peserta/".$fileName, file_get_contents($gambar));

                }
            }else {
                $kirim = true;
                $data = pesertaM::where('idpeserta', $idpeserta)->first();
                $fileName = $data->gambar;
            }


            if($kirim) {
                pesertaM::where('idpeserta', $idpeserta)->delete();

                $upload = new pesertaM;
                $upload->idpeserta = $idpeserta;
                $upload->namapeserta = $namapeserta;
                $upload->kontingen = $kontingen;
                $upload->jk = $jk;
                $upload->wa = $wa;
                $upload->gambar = $fileName;
                $upload->save();

                if($upload){
                    $request->session()->put('nama', $namapeserta);
                    return redirect('pendaftaran')->with('success', 'Identitas Berhasil Diubah');
                }                    
            }
        }catch(\Throwable $th){
            return redirect('identitas')->with('toast_error', 'Terjadi kesalahan');
        }
    }

    public function ubahpassword(Request $request)
    {
        $request->validate([
            'password1' => 'required',
            'password2' => 'required|same:password1',
        ]);
        
        
        try{
            $idregistrasi = $request->session()->get('id');
            $password = Hash::make($request->password1);
        
            $update = registrasiM::where('idregistrasi', $idregistrasi)->update([
                'password' => $password,
            ]);

            if($update) {
                return redirect()->back()->with('toast_success', 'Password successfully changed');
            }
        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
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
