<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adresse extends Model
{
    protected $table = 'adresse';
    public $timestamps = false;
    protected $primaryKey = 'codeAdresse';
    protected $fillable = [
        'codeAdresse','rueAdresse','cpAdresse','villeAdresse','codeEntrepriseAdresse',
    ];
    
    
    public function entreprise()
    {
        return $this->belongsTo('App\entreprise','codeEntrepriseAdresse','codeEntreprise');
    }
}
