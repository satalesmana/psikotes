<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DimensiMaping extends Model
{
    protected $table = 'dimensi_maping';
    protected $fillable = ['dimensiAid','dimensiBid','label'];
}
