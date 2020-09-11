<?php

namespace App\Repositories;

use App\session;

class r_session extends r_repository implements sessionInterface
{
    
    public function __construct(session $session)
    {
        $this->model = $session;
    }
    
    private function getInformations()
    {
        return $this->model->select('session.codeSession','libelleFormation','descriptionFormation','libelleDom','cpSite','rueSite','villeSite','libelleSite'
                ,'maxSession','prixFormation','codeFormation','codeDom','desDom')
                ->selectRaw('date_format(dateD,"%d/%m/%Y") as dateSession')
                ->selectRaw('date_format(dateF,"%d/%m/%Y") as dateFinSession')
                ->selectRaw('if(sum(nbStagiaires) is null,0,sum(nbStagiaires)) as nbClients')
                ->selectRaw('count(codeSessionHoraire) as duree')
                ->join('formation','codeFormationSession','=','codeFormation')
                ->join('horairesession','codeSession','=','codeSessionHoraire')
                ->join('domaine','codeDom','=','codeDomFormation')
                ->leftJoin('inscrire','inscrire.codeSession','=','session.codeSession')
                ->join('site','codeSite','=','codeSiteSession')
                ->groupBy('session.codeSession',
                        'libelleSite','rueSite','villeSite','cpSite',
                        'codeDom','libelleDom','desDom',
                        'codeFormation','libelleFormation','descriptionFormation','maxSession','prixFormation',
                        'codeSessionHoraire')
                ->orderBy('dateSession','desc');
    }
    
    public function getRelated($id)
    {
        return $this->getInformations()->where('codeFormationSession',function ($id)
        {
            return $query->select('codeFormationSession')
                    ->where('codeSession',$id);
        });
    }
    
    public function getById($id) {
       return $this->getInformations()->findOrFail($id);
    }

    public function all()
    {
        return $this->getInformations()->get();
    }
    
    public function getPaginate($nb)
    {
        return $this->getInformations()->paginate($nb);
    }
}

