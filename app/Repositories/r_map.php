<?php

namespace App\Repositories;

use Cornford\Googlmapper\Mapper;

class r_map
{
    protected $mapper;
    
    public function __construct(Mapper $mapper)
    {
        $this->mapper = $mapper;
    }
    
    public function getLocation($adresse)
    {
        return $this->mapper->location($adresse,render);
    }
}

