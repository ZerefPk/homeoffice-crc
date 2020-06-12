<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\HomeOfficeRequest;
use App\Detalhe;
use App\Http\Requests\DetalheRequest;
use App\Relatorio;
use App\Anexo;

class HomeOfficeController extends Controller
{
    //
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','pendencia']);
        
    }

    public function storeRelatorio(DetalheRequest $request)
    {
        $dataForm = $request->all();
        $relatoriId = Relatorio::where('user_id', auth()->user()->id)->where('data_referencia', date('y-m-d'))->first();

        
        $create = Detalhe::create([
            'periodo' => session('periodo'),
            'descricao' => $dataForm['descricao'],
            'relatorio_id' => $relatoriId->id,
            'curso' => $dataForm['curso'],
        ]);
        $route = "relatorio-".strtolower(session('periodo'));
        
        if($create)
        {

            $this->storeAnexos($request,$create->id);
            return redirect()->back()->with('success',"PERIODO DA ".session('periodo')." ADICIONADO COM SUCESSO!");
        }
        return redirect()->back()->with("error", " ERRO AO ADICIONAR PERIODO DA ".session('periodo'));

    }
    public function upRelatorio(DetalheRequest $request, $id)
    {
        $dataForm = $request->all();
        $update = Detalhe::find($id);


        $up = $update->update([
            'descricao' => $dataForm['descricao'],
            'curso' => $dataForm['curso'],
        ]);

        
        if($up)
        {
            $this->storeAnexos($request,$update->id);
            return redirect()->back()->with('success',"PERIODO DA ".$update->periodo." ATUALIZADO COM SUCESSO!");
        }
        return redirect()->back()->with("error", " ERRO AO ATUALIZAR PERIODO DA ".$update->periodo);
    }
    public function destroy($id)
    {

        $delete = Detalhe::find($id);
        foreach($delete->anexos as $anexo)
        {
            $this->deleteFile($anexo->id);
        }
        $delete = $delete->delete();
        
        if($delete)
        {
            return redirect()->back()->with('success',"PERIODO DA ".session('periodo')." DELETADO COM SUCESSO!");
        }
        return redirect()->back()->with("error", " ERRO AO DELETADO PERIODO DA ".session('periodo'));
    }
    public function downloadAnexo($id)
    {
        $data = Anexo::where('id', $id)->first();

        return \Storage::download('anexos/'.$data->path, $data->name);
    }
    public function removerAnexo($anexo){
        $this->deleteFile($anexo);
        return redirect()->back()->with('success','ANEXO REMOVIDO COM SUCESSO');
    }
    public function efetivar()
    {
        $update = Relatorio::where('data_referencia', date('y-m-d'))
        ->where('user_id', auth()->user()->id)->first();
        $update = $update->update([
            'pendencia' => 0,
        ]);
        if($update)
        {
            return redirect()->route('home');
        }
        return redirect()->route('home');
    }
    public function storeAnexos(Request $request, $id)
    {
        $data = date('y-m-d');
        $path = auth()->user()->id."/{$data}";
        $hora = date('s-H-i');
        //dd($request->anexos[0]);
        if($request->anexos != null)
        {
            $i = 0;
            foreach($request->anexos as $anexo)
            {
                $ex = $anexo->extension();
                $name = $anexo->getClientOriginalName();
                $nameFile = "{$path}"."/"."{$data}-{$hora}"."-"."{$i}"."."."{$ex}";
                $insert = $request->anexos[$i]->storeAs('anexos', $nameFile);

                if(!$insert)
                {
                    \Storage::deleteDirectory($path);
                    Detalhe::destroy($id);
                    return redirect()->back()->with('error', 'ERRO AO SALVAR ANEXO');
                }


                $anexo = Anexo::create([
                    'name' => $name,
                    'path' => $nameFile,
                    'detalhe_id' => $id,
                    
                ]);
                $i++;
            }
        }

        return true;
    }
    public function deleteFile($id)
    {
        $data = Anexo::where('id', $id)->first();
        $path = $data->path;
        $path = \Storage::delete('anexos/'.$path);
        
        if($path)
        {
            $data = Anexo::destroy($data->id);
            
            if($data)
            {
                return;
            }

        }
        return redirect()->back()->with('error','UM ERRO OCORREU - COD 02');
    }
    
   
}
