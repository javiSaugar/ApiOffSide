<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Instalacion;
use App\Models\Deporte;
use App\Models\Usuario;
use App\Models\Actividad;
class Sesiones extends Model
{

     protected $table='sesiones';
    protected $primaryKey = 'ses_id';

     protected $casts=[
        'ses_id'=>'int',
        'ses_fecha'=>'date',
        'ses_ins_id'=>'int',
        'ses_dep_id'=>'int',
        'mat_use_id'=>'int',
        'ses_precio'=>'float'
    ];
      protected $fillable=[
        'ses_hora',
        'ses_nombre'
    ];


        public function instalacion()
    {
        return $this->belongsTo(Instalacion::class, 'ses_ins_id');
    }

    public function deporte()
    {
        return $this->belongsTo(Deporte::class, 'ses_dep_id');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'ses_use_id');
    }

    public function actividades()
    {
        return $this->hasMany(Actividad::class, 'act_ses_id');
    }
}
