<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class site extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'codeSite';
    protected $table = 'site';
    
    public function sessions()
    {
        return $this->hasMany('App\session');
    }
}
