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
    //para que los campos que genera automaticamente no los pide
    public $timestamps = false;

    protected $casts = [
        'ses_id'     => 'int',
        'ses_fecha'  => 'date',
        'ses_ins_id' => 'int',
        'ses_dep_id' => 'int',
        'ses_use_id' => 'int', // corregido aquí
        'ses_precio' => 'float',
    ];

    protected $fillable = [
        'ses_hora',
        'ses_fecha',
        'ses_ins_id',
        'ses_dep_id',
        'ses_use_id', // corregido aquí también
        'ses_precio',
        'ses_nombre',
    ];

    // Relaciones
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
        return $this->belongsTo(User::class, 'ses_use_id');
    }

    public function actividades()
    {
        return $this->hasMany(Actividad::class, 'act_ses_id');
    }
}
