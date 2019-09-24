<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Oficina extends Model
{
    // a que tabla hace referencia
    protected $table='oficina';
    protected $primaryKey="id_oficina";
    public $timestamps=false;

    protected $fillable=[
        'nombre',
        'direccion',
        'estado'
    ];

    protected $guarded=[
        
    ];
}
