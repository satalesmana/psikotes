<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MbtiSoal extends Model
{
    protected $table = 'mbti_soal';
    protected $fillable = ['pernyataanA','dimensiA','pernyataanB','dimensiB','groupdimensi'];
}
