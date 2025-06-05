<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deporte extends Model
{
     protected $table='deportes';
    protected $primaryKey = 'dep_id';
    public $timestamps = false;

     protected $casts=[
        'dep_id'=>'int',
        'dep_numparticipantes'=>'int'
       
    ];
   
    protected $fillable=[
        'dep_nombre',
        'dep_numparticipantes'
    ];

        public function sesiones()
    {
        return $this->hasMany(Sesion::class, 'ses_dep_id');
    }

}
