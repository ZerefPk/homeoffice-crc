<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Detalhe;
use App\Relatorio;
use App\User;
use App\Anexo;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','pendencia']);
       
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        return view('home');
        
    }
   
    public function relatorioManha()
    {
        $info = Relatorio::where('user_id',  auth()->user()->id)
                    ->where("data_referencia",  date('Y-m-d'))
                    ->where('user_id', auth()->user()->id)
                    ->first();
        $info= $info->detalhes()->where('periodo','MANHÃ')->first();
        session()->forget('periodo');
        session()->put('periodo','MANHÃ');
        //dd($manha);
        $valid = $this->verificarEnvio();
        if($valid)
        {
            return redirect()->route('confirmacao');
        }
        if($info)
        {    
            return view('modelo-relatorio',compact('info'));
        }
        
        return view('modelo-relatorio');
    }
    public function relatorioTarde()
    {
        $info = Relatorio::where('user_id',  auth()->user()->id)
                    ->where("data_referencia",  date('Y-m-d'))
                    
                    ->first();
        $info= $info->detalhes()->where('periodo','TARDE')->first();
        session()->forget('periodo');
        session()->put('periodo','TARDE');
        
        $valid = $this->verificarEnvio();
        if($valid)
        {
            return redirect()->route('confirmacao');
        }
        
        if($info)
        {    
            return view('modelo-relatorio',compact('info'));
        }
        return view('modelo-relatorio');
    }
    
    
    public function confirmacao()
    {
        $update = Relatorio::where('data_referencia', date('y-m-d'))
        ->where('user_id', auth()->user()->id)->first();

        
        if($update->pendencia ==0)
        {
           
            return view('confirmacao');
        }

        return redirect()->route('home');
    }
    public function verificarEnvio()
    {
        $update = Relatorio::where('data_referencia', date('y-m-d'))
        ->where('user_id', auth()->user()->id)->first();
        
        if($update->pendencia == 0)
        {
            
            return true;
        }
        return false;

       
    }
    public function relatorios()
    {
        $relatorios = Relatorio::where('user_id', auth()->user()->id)->paginate(5);

        return view('list-relatorios', compact('relatorios'));

    }
    public function relatoriosBuscar(Request $request)
    {
        $busca = $request->all();
        $busca = $busca['busca'];
        $relatorios = Relatorio::where('user_id', auth()->user()->id)
        ->where('data_referencia', $busca)->paginate(5);

        return view('list-relatorios', compact('relatorios', 'busca'));

    }
    public function detalhe($id)
    {
        $relatorio = Relatorio::where('id', $id)->where('user_id', auth()->user()->id)->first();
        $manha = $relatorio->detalhes()->where('periodo',"MANHÃ")->first();
        $tarde = $relatorio->detalhes()->where('periodo',"TARDE")->first();
        return view('detalhe-relatorio',compact('relatorio', 'manha', 'tarde'));

        
    }
    
    public function baixar($id)
    {
        $user= auth()->user();
        $relatorio = Relatorio::where('id', $id)->where('user_id', $user->id)->first();
        $manha = $relatorio->detalhes()->where('periodo',"MANHÃ")->first();
        $tarde = $relatorio->detalhes()->where('periodo',"TARDE")->first();

        $namepdf="relatorio-{$relatorio->data_referencia}.pdf";
        $nome = $user->name;
        return \PDF::loadView('pdf-modelo-1',compact('relatorio', 'manha', 'tarde','nome'))
            ->download($namepdf);
    }
    
   
    
}
