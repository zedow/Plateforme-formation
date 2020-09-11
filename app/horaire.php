<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class horaire extends Model
{
    public $timestamps = false;
    protected $table = 'horaire';
    protected $primaryKey = 'codeHoraire';
    protected $fillable = [
        'dateH','heureD','heureF','heureDA','heureFA','codeSessionHoraire'
    ];
    
    public function session()
    {
        return $this->belongsTo('App\session','codeSessionHoraire','codeSession');
    }
}
