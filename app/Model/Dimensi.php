<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Dimensi extends Model
{
    protected $table = 'dimensi';
    protected $fillable = ['code','description'];
}
