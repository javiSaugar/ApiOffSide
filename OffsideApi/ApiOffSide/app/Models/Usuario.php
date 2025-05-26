<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table='usuarios';
     protected $primaryKey = 'Use_id';
    public $timestamps = false;
    protected $casts=[
        'Use_id'=>'int'
    ];
   
    protected $fillable=[
        'Use_Nom',
        'Use_ApeNom',
        'Use_telf',
        'Use_mail'
    ];

      public function materiales()
    {
        return $this->hasMany(Material::class, 'mat_use_id');
    }

    public function sesiones()
    {
        return $this->hasMany(Sesion::class, 'ses_use_id');
    }

    public function actividades()
    {
        return $this->hasMany(Actividad::class, 'act_use_id');
    }


}
