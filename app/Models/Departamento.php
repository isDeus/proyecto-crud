<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    use HasFactory;

    public function equipos(){
        return $this->hasMany('App\Models\Equipo', 'departamento_id', 'id');
    }
}
