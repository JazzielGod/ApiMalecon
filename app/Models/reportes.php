<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reportes extends Model
{
    use HasFactory;

    protected $fillable = [
        'num_reporte',
        'nombre',
        'area',
        'problema'
    ];
}
