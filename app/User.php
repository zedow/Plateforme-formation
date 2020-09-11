<?php

namespace App;
// Le namespace est défini pour faire savoir à l'application où se trouve ce fichier

use Illuminate\Foundation\Auth\User as Authenticatable;
// User hérite de classe Authentificable qui gère le modèle déstiné à l'authentification

class User extends Authenticatable
{
    protected $table = 'client';
    // timestemps false définie que la table ne possède pas de colonne created_at et uptdated_at
    public $timestamps = false;
    protected $primaryKey = 'codeClient';
    
    protected $fillable = [
        'nomClient','prenomClient',
        'email', 
        'password',
        'civClient',
        'statutClient',
        'telClient',
        'codeEntrepriseClient',
        'ville',
        'dateNaissance',
        'adresse',
        'cp',
        'compAdresse',
        
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function adresses()
    {
        return $this->hasMany('App\Adresse','codeClientAdresse','codeClient');
    }
    
    public function entreprise()
    {
        return $this->hasOne('App\entreprise','codeClientEntreprise','codeClient');
    }
    
}
