<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Relatorio;
use App\Detalhe;
class AdmController extends Controller
{
    //
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
       
        
    }
   
    public function listFuncionarios()
    {
        $funcionarios = User::paginate(5);
        return view('adm.list-funcionarios', compact('funcionarios'));
    }

    public function detalheFuncionario($id)
    {
        $funcionario = User::find($id);
        $relatorios = Relatorio::where('user_id', $id)->where('pendencia',0)->paginate(5);
        return view('adm.detalhe-funcionario', compact('funcionario','relatorios'));
    }
    public function detalheRelatorio($id, $idFun)
    {
        $funcionario = User::find($idFun);
       
        $relatorio = Relatorio::where('id', $id)->where('user_id', $funcionario->id)->where('pendencia',0)->first();
        
        $manha = $relatorio->detalhes()->where('periodo',"MANHÃ")->first();
        $tarde = $relatorio->detalhes()->where('periodo',"TARDE")->first();
        
        return view('adm.detalhe-relatorio',compact('funcionario','relatorio', 'manha', 'tarde'));
    }
    public function funcionariosBusca(Request $request)
    {
        $busca = $request->all();
        $busca = $busca['busca'];
        $funcionarios = User::where('name', 'like', "%{$busca}%")
        ->paginate(5);

        return view('adm.list-funcionarios', compact('funcionarios', 'busca'));

    }
    public function relatoriosBuscaFun(Request $request,$id)
    {
        $funcionario = User::find($id);
        $busca = $request->all();
        $busca = $busca['busca'];
        $relatorios = Relatorio::where('user_id', $id)
        ->where('data_referencia', $busca)->paginate(5);

        return view('list-relatorios', compact('relatorios', 'busca','funcionario'));

    }
    public function pdfIndividual($id, $idUser)
    {
        $user= User::find($idUser);
        $relatorio = Relatorio::where('id', $id)->where('user_id', $idUser)->first();
        $manha = $relatorio->detalhes()->where('periodo',"MANHÃ")->first();
        $tarde = $relatorio->detalhes()->where('periodo',"TARDE")->first();

        $nome = $user->name;
        $namepdf="{$nome}-{$relatorio->data_referencia}.pdf";
        
        return \PDF::loadView('pdf-modelo-1',compact('relatorio', 'manha', 'tarde','nome'))
            ->download($namepdf);
        //return view('pdf-modelo-1',compact('relatorio', 'manha', 'tarde','nome'));

        
    }
    public function simplificado(Request $request)
    {
        $dataForm = $request->all();
        $inicio = $dataForm['inicio'];
        $final = $dataForm['final'];

        $countFunc = User::count();

        $users = User::all();
        $countOc = Relatorio::whereBetween('data_referencia', [$inicio, $final])->orderBy('user_id','asc')->count();
        $namepdf= "RELATORIO-SIMPLIFICADO-{$inicio}-A-{$final}.pdf";
        if($countOc>0)
        {
            //information: "name", "id","ocorrencias" | object: 
            //data = [[[],[]],[[],[]]
            $list=[];
            foreach($users as $user)
            {
                $datas = $user->relatorios()->whereBetween('data_referencia', [$inicio, $final])->get();
            
                $temp1= [];
                foreach($datas as $data)
                {
                    array_push($temp1, $data);
                }
                $temp = ['name'=> $user->name,'id' => $user->id, 'ocorrencias' => count($datas),'objects' => $temp1];
                array_push($list, $temp);
            }
            
            return \PDF::loadView('adm.relatorio-simplificado', compact('list', 'countFunc', 'inicio', 'final','countOc'))
                        ->download($namepdf);
        }
        
        return \PDF::loadView('adm.relatorio-nulo', compact('countFunc', 'inicio', 'final','countOc'))
                ->download($namepdf);
    
    }
    public function completo(Request $request)
    {
        $dataForm = $request->all();
        $inicio = $dataForm['inicio'];
        $final = $dataForm['final'];

        $countFunc = User::count();

        $users = User::all();
        $countOc = Relatorio::whereBetween('data_referencia', [$inicio, $final])->orderBy('user_id','asc')->count();
        $namepdf= "RELATORIO-SIMPLIFICADO-{$inicio}-A-{$final}.pdf";
        if($countOc>0)
        {
            //information: "name", "id","ocorrencias" | object: 
            //data = [[[],[]],[[],[]]
            $list=[];
            foreach($users as $user)
            {
                $datas = $user->relatorios()->whereBetween('data_referencia', [$inicio, $final])->get();
            
                $temp1= [];
                foreach($datas as $data)
                {
                    array_push($temp1, $data);
                }
                $temp = ['name'=> $user->name,'id' => $user->id, 'ocorrencias' => count($datas),'objects' => $temp1];
                array_push($list, $temp);
            }
            
            return \PDF::loadView('adm.relatorio-completo', compact('list', 'countFunc', 'inicio', 'final','countOc'))
                        ->download($namepdf);
        }
        
        return \PDF::loadView('adm.relatorio-nulo', compact('countFunc', 'inicio', 'final','countOc'))
                ->download($namepdf);
    
    }
}
