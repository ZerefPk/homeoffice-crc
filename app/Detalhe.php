<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detalhe extends Model
{
    //
    protected $table = "detalhe";
    protected $fillable = [
        'id',
        'periodo',
        'descricao',
        'relatorio_id',
        'curso',

    ];
    protected $foreignKey= 'relatorio_id';

    public function relatorio()
    {
        return $this->belongsTo(Relatorio::class);
    }
    public static function periodo($periodo, $dataReferencia)
    {
        $relatorio = Relatorio::where('data_referencia', $dataReferencia)->first();
        
        
        foreach($relatorio->detalhes as $data)
        {
            
            if($data->periodo==$periodo)
            {
                return $data;
            }
        }
        return null;
    }

    public function anexos(){

        return $this->hasMany(Anexo::class);
    }
}
