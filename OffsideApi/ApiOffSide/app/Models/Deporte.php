<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deporte extends Model
{
     protected $table='deportes';
    protected $primaryKey = 'dep_id';

     protected $casts=[
        'dep_id'=>'int',
        'dep_numParticipantes'
       
    ];
   
    protected $fillable=[
        'dep_Nombre'
    ];

        public function sesiones()
    {
        return $this->hasMany(Sesion::class, 'ses_dep_id');
    }

}
