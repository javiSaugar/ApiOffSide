<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Instalacion extends Model
{
     protected $table='instalaciones';
     protected $primaryKey = 'ins_id';
    public $timestamps = false;
     protected $casts=[
        'ins_id'=>'int',
        'ins_num'=>'int'
    ];
   
    protected $fillable=[
        'ins_nombre',
        'ins_localidad',
        'ins_calle',
         'ins_num',
        'ins_coordenadas'
    ];

     public function sesiones()
    {
        return $this->hasMany(Sesion::class, 'ses_ins_id');
    }
}
