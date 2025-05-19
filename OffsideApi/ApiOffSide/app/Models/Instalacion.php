<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Instalacion extends Model
{
     protected $table='instalaciones';
     protected $primaryKey = 'ins_id';

     protected $casts=[
        'ins_id'=>'int',
        'ins_num'=>'int'
    ];
   
    protected $fillable=[
        'ins_Nombre',
        'ins_localidad',
        'ins_calle',
        'ins_coordenadas'
    ];

     public function sesiones()
    {
        return $this->hasMany(Sesion::class, 'ses_ins_id');
    }
}
