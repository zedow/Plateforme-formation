<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class reunion extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'codeReunion';
    protected $table = 'reunion';
}
