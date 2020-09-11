<?php

namespace App\Repositories;

use App\horaire;

class r_horaire extends r_repository implements horaireInterface
{
    public function __construct(horaire $horaire)
    {
        $this->model = $horaire;
    }
    
    public function getHoraireSession($id)
    {
        return $this->model->selectRaw('date_format(dateH,"%d/%m/%Y") as dateH')
                ->selectRaw('time_format(heureD,"%H:%m") as heureD')
                ->selectRaw('time_format(heureF,"%H:%m") as heureF')
                ->selectRaw('time_format(heureDA,"%H:%m") as heureDA')
                ->selectRaw('time_format(heureFA,"%H:%m") as heureFA')
                ->where('codeSessionHoraire',$id)->get();
    }
}
