<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class formation extends Model
{
    public $timestamps = false;
    protected $table = 'formation';
    protected $primaryKey = 'codeFormation';
    
    public function sessions()
    {
        return $this->hasMany('App\session');
    }
    
    public function domaine()
    {
        return $this->belongsTo('App\domaine');
    }
    
    public function niveaux()
    {
        return $this->belongsToMany('App\niveau','niveauform','codeFormation','codeNiveau');
    }
    
    public function entreprises()
    {
        return $this->belongsToMany('App\entreprise');
    }
}
