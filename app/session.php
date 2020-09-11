<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class session extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'codeSession';
    protected $table = 'session';
    protected $casts = [
        'dateSession' => 'date:d/m/Y',
    ];
    protected $fillable = [
        'codeSiteSession', 'dateSession','dateFinSession','heureDebut','heureFin','heureDebutA','heureFinA','maxSession',
    ];
    
    public function formation()
    {
        return $this->belongsTo('App\formation');
    }
    
    public function niveaux()
    {
        return $this->belongsToMany('App\niveau','niveauform','codeFormation','codeNiveau');
    }
    public function site()
    {
        return $this->belongsTo('App\site');
    }
    
    public function horaires()
    {
        return $this->hasMany('App\horaire','codeSessionHoraire','codeSession');
    }
}
