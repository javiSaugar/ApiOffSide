<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    protected $table='actividades';
    protected $primaryKey = 'act_id';
    public $timestamps = false;
    protected $fillable = ['act_ses_id', 'act_use_id'];
     protected $casts=[
        'act_id'=>'int',
        'act_ses_id'=>'int',
        'act_use_id'=>'int'
    ];
      public function sesion()
    {
        return $this->belongsTo(Sesiones::class, 'act_ses_id');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'act_use_id');
    }
}
