<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anexo extends Model
{
    //
    protected $table = "anexo";

    protected $fillable  = 
    [
        'name',
        'path',
        'detalhe_id'
    ];

    protected $primaryKey = "id";
}
