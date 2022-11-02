<?php

namespace App\Http\Controllers;

use App\Models\registrasiM;
use App\Models\pertandinganM;
use App\Models\pengaturanM;
use Hash;
use Illuminate\Http\Request;

class authC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function proses(Request $request)
    {

        $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);

        try{
            $email = $request->email;
            $cek = registrasiM::where('email', $email);

            if($cek->count() === 1){
                $password = $request->password;
                if(Hash::check($password, $cek->first()->password)) {
                    $pengaturan = pengaturanM::first();
                    $pendaftaran = (boolean) $pengaturan->pendaftaran;
                    
                    $request->session()->put('login', true);
                    $request->session()->put('pendaftaran', $pendaftaran);
                    $request->session()->put('id', $cek->first()->idregistrasi);
                    $request->session()->put('nama', $cek->first()->namaregistrasi);
                    $request->session()->put('email', $cek->first()->email);

                    $idpeserta = $request->session()->get('id');
                    $cek = pertandinganM::where('idpeserta', $idpeserta)->count();

                    if($cek === 1) {
                        return redirect('home')->with('toast_success', 'welcome');
                    }else {
                        return redirect('pendaftaran')->with('toast_success', 'welcome');
                    }
                }
            }

            $request->session()->flush();
            return redirect('login')->with('toast_error', 'email or password is wrong');
        }catch(\Throwable $th){
            return redirect('login')->with('toast_error', 'email or password is wrong');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('login');
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
     * @param  \App\Models\registrasiM  $registrasiM
     * @return \Illuminate\Http\Response
     */
    public function show(registrasiM $registrasiM)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\registrasiM  $registrasiM
     * @return \Illuminate\Http\Response
     */
    public function edit(registrasiM $registrasiM)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\registrasiM  $registrasiM
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, registrasiM $registrasiM)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\registrasiM  $registrasiM
     * @return \Illuminate\Http\Response
     */
    public function destroy(registrasiM $registrasiM)
    {
        //
    }
}
