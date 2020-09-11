<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class entreprise extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'codeEntreprise';
    protected $table = "entreprise";
    protected $fillable = [
        'codeEntreprise','nomEntreprise','SIRET','villeEnt','cpEnt','adresseEnt','compEnt','codeClientEntreprise'
    ];
    
    public function client()
    {
        return $this->belongsTo('App\client');
    }
    
    public function demandes()
    {
        return $this->belongsToMany('App\formation');
    }
    
    public function user()
    {
        return $this->hasOne('App\User','codeEntrepriseClient','codeEntreprise');
    }
    
    public function adresses()
    {
        return $this->hasMany('App\Adresse','codeEntrepriseAdresse','codeEntreprise');
    }
}
