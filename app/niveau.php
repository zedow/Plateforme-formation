<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class niveau extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'codeNiveau';
    protected $table = 'niveau';
    
    public function formations()
    {
        return $this->belongsToMany('App\formation');
    }
    
    public function domaines()
    {
        return $this->belongsToMany('App\domaine');
    }
}
