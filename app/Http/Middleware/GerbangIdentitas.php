<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\pesertaM;

class GerbangIdentitas
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
        $idpeserta = $request->session()->get('id');
        $cek = pesertaM::where('idpeserta', $idpeserta)->count();
        if($cek == 1) {
            return $next($request);
        }else {
            return redirect('identitas')->with('warning', 'Silahkan lengkapi identitas');
        }
    }
}
