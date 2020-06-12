<?php

namespace App\Http\Middleware;

use Closure;
use App\Detalhe;
use App\Relatorio;

class Pendencia
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $this->verificarPendencia();
        return $next($request);
    }
    public function verificarPendencia()
    {
        $relatoriId = Relatorio::where('data_referencia', date('y-m-d'))
                ->where('user_id', auth()->user()->id)->first();
        if(!$relatoriId)
        {
            $relatoriId = Relatorio::create([
                'data_referencia' => date('y-m-d'),
                'user_id' => auth()->user()->id,
                'pendencia' => 1,
            ]);
        }
        
        $manha = Detalhe::where('relatorio_id', $relatoriId->id)
            ->where('periodo',"MANHÃ")
            ->first();
        $tarde = Detalhe::where('relatorio_id', $relatoriId->id)
            ->where('periodo',"TARDE")
            ->first();
        $relatoriId = (!$relatoriId->pendencia)? "OK":"EM FALTA"; 

            
        $manha = ( $manha ) ? "OK" : "EM FALTA" ;
        $tarde = ( $tarde ) ? "OK" : "EM FALTA" ;
        
        if($manha=="EM FALTA"  || $tarde == "EM FALTA" || $relatoriId == "EM FALTA" and $relatoriId != "OK" )
            session()->put('pendencia', "Relatorio com pendência! <br> Manhã: {$manha} | Tarde: {$tarde} | ENVIAR AO RH: {$relatoriId} ");
        else
            session()->forget('pendencia');
            
    }
}
