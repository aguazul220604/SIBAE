<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Circuito extends Model
{
    protected $primaryKey = 'id_circuito';
    public $timestamps = false;
    protected $table = 'circuito';
}
