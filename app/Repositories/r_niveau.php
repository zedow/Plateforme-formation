<?php

namespace App\Repositories;

use App\niveau;

class r_niveau extends r_repository implements niveauInterface
{
    public function __construct(niveau $niveau)
    {
        $this->model = $niveau;
    }
    
    public function getNiveauxFormation($id)
    {
        return $this->model->select('libelleNiveau')
                ->join('niveauform','codeNiveauNF','=','codeNiveau')
                ->where('codeFormationNF',$id)
                ->get();
    }
}