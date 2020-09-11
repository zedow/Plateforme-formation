<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class inscrirereunion extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    protected $primaryKey = ['codeClient','codeReunion'];
    protected $table = 'inscrirereunion';
}
