<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class demande extends Model
{
    public $timestamps = false;
    protected $primaryKey = ['codeEntreprise','codeFormation'];
    protected $table = 'demande';
    
    protected $fillable = [
        'codeEntreprise',
        'codeFormation',
        'lieu',
        'raison',
        'stagiaires',
        'dateD',
        'dateF'
    ];
    
}
