<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\pertandinganM;
use App\Models\pesertaM;

class GerbangPertandingan
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $cek = pertandinganM::join('peserta', 'peserta.idpeserta', 'pertandingan.idpeserta')
        ->join('lomba', 'lomba.idlomba', 'pertandingan.idlomba')
        ->where('lomba.ket', true)
        ->where('pertandingan.sah', true)
        ->where('peserta.idpeserta', $request->session()->get('id'))
        ->count();
        if($cek > 0){
            return redirect()->back()->with('toast_error', 'Pertandingan saat ini telah disahkan sehingga tidak dapat merubah identitas saat ini.');
        }else {
            return $next($request);
        }
    }
}
