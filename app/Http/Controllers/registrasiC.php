<?php

namespace App\Http\Controllers;

use App\Models\registrasiM;
use App\Models\hintM;
use Illuminate\Http\Request;

use Hash;

class registrasiC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function login(Request $request)
    {
        return view('auth.login');
    }

    public function register(Request $request)
    {
        $hint = hintM::get();
        return view('auth.register', [
            'hint' => $hint
        ]);
    }

    public function forgot(Request $request)
    {
        $hint = hintM::get();
        return view('auth.forgot', [
            'hint' => $hint
        ]);
    }

    public function resetpassword(Request $request)
    {
        $request->validate([
            'email'=>'required|email',
            'hint'=>'required',
            'answer'=>'required',
            'password'=>'required|min:6',
            'password_confirm'=>'required|same:password|min:6',
        ],[
            'regex' => 'need lowercase, uppercase and numbers'
        ]);

        try{
            $email = $request->email;
            $idhint = $request->hint;
            $jawaban = $request->answer;

            $password = Hash::make($request->password);

            $cek = registrasiM::where('email', $email)
            ->where('idhint', $idhint)
            ->where('jawaban', $jawaban);
            
            if($cek->count() === 1) {
                $tambah = registrasiM::where('email', $email)
                ->where('idhint', $idhint)
                ->where('jawaban', $jawaban)->update([
                    'password' => $password
                ]);

                if ($tambah) {
                    return redirect('login')->with('success', 'password changed successfully');
                }
                
            } 

            return redirect('login')->with('toast_error', 'password failed to change');
        }catch(\Throwable $th){
            return redirect('login')->with('toast_error', 'password failed to change');
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
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:registrasi,email',
            'hint'=>'required',
            'answer'=>'required',
            'setuju'=>'required',
            'password'=>'required|min:6',
            'password_confirm'=>'required|same:password|min:6',
        ],[
            'regex' => 'need lowercase, uppercase and numbers'
        ]);

        $request->validate([
            'name' => 'required',
        ]);
        
        
        try{
            $namaregistrasi = $request->name;
            $email = $request->email;
            $idhint = $request->hint;
            $jawaban = $request->answer;
            $password = Hash::make($request->password);
        
            $store = new registrasiM;
            $store->idhint = $idhint;
            $store->jawaban = $jawaban;
            $store->email = $email;
            $store->namaregistrasi = $namaregistrasi;
            $store->password = $password;
            $store->save();
            if($store) {
                return redirect('login')->with('toast_success', 'success');
            }
        }catch(\Throwable $th){
            return redirect('register')->with('toast_error', 'Terjadi kesalahan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\registrasi  $registrasi
     * @return \Illuminate\Http\Response
     */
    public function show(registrasiM $registrasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\registrasi  $registrasi
     * @return \Illuminate\Http\Response
     */
    public function edit(registrasiM $registrasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\registrasi  $registrasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, registrasiM $registrasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\registrasi  $registrasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(registrasiM $registrasi)
    {
        //
    }
}
