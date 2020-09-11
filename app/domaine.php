<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class domaine extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'codeDom';
    protected $table = 'domaine';
    
    public function formations()
    {
        return $this->hasMany('App\formation');
    }
    
    public function niveaux()
    {
        return $this->belongsToMany(('App\niveau'));
    }
}
