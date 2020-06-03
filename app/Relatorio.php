<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Relatorio extends Model
{
    //
    protected $table = "relatorio";
    protected $fillable = [
        'id',
        'user_id',
        'data_referencia',
        'pendencia',

    ];

    public function detalhes()
    {
        return $this->hasMany(Detalhe::class, 'relatorio_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
