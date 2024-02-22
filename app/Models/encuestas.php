<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class encuestas extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'num_pregunta',
        'pregunta',
        'respuesta',
    ];
}
