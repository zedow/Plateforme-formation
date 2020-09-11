<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class inscrire extends Model
{
    public $timestamps = false;
    protected $primaryKey = ['codeClient','codeFormationSession','codeSession'];
    public $incrementing = false;
    protected $table = 'inscrire';
}
