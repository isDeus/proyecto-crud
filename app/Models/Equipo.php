<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory;

    public function departamento(){
        return $this->hasOne('App\Models\Departamento', 'id', 'categoria_id');
    }
}
