<?php

namespace App\Repositories;

use App\Adresse;

class r_adresse extends r_repository
{
    public function __construct(Adresse $d)
    {
        $this->model = $d;
    }
    public function getByEntrepriseOrClient($id)
    {
        return $this->model->where('codeClientAdresse',$id)->orWhere('codeEntrepriseAdresse',$id)->get();
    }
    public function store(Array $inputs)
    {
        if(is_null($inputs['codeClientAdresse']))
        {
            $id = $this->getByEntrepriseOrClient($inputs['codeEntrepriseAdresse']);
        }
        else
        {
            $id = $this->getByEntrepriseOrClient($inputs['codeClientAdresse']);
        }
        if(is_null($id))
        {
            return $this->store($inputs);
        }
        else
        {
            return $this->update($id->codeAdresse, $inputs);
        }   
    }
    
    public function destroyByEntreprise($id)
    {
        return $this->model->where('codeEntrepriseAdresse',$id)->delete();
    }
}
