<?php

namespace App\Repositories;

use App\entreprise;

class r_entreprise extends r_repository
{
    protected $user;
    public function __construct(entreprise $d)
    {
        $this->model = $d;
    }
    public function adresses($id)
    {
        return $this->model->find($id)->adresses;
    }
    
    public function getByClient($id)
    {
        return $this->model->where('codeClientEntreprise',$id)->first();
    }
    public function store(Array $inputs)
    {
        $ent = $this->getByClient($inputs['codeClientEntreprise']);
        if(empty($ent))
        {
            return $this->model->create($inputs);
        }
        else
        {
            return $this->update($ent->codeEntreprise,$inputs);
        }
    }
}

