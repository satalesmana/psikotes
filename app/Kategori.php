<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table ='kategoris';
    protected $fillable = ['id','kategori_name','bobot'];
    

}
