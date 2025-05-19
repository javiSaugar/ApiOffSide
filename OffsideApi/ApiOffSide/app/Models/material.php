<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class material extends Model
{
     protected $table='material';
   
     protected $casts=[
        'mat_use_id'=>'int'
    ];
      protected $fillable=[
        'mat_pass'
    ];
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'mat_use_id');
    }
   
}
