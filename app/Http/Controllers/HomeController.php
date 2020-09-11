<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Repositories\sessionInterface;
use App\Repositories\niveauInterface;

class HomeController extends Controller
{
    protected $sInterface;
    protected $nInterface;
    
    public function __construct(sessionInterface $sInterface,niveauInterface $nInterface)
    {
        $this->sInterface = $sInterface;
        $this->nInterface = $nInterface;
    }

    public function index()
    {
        $formations = $this->sInterface->all()->take(3);
        foreach($formations as $formation)
        {
            $niveaux = $this->nInterface->getNiveauxFormation($formation->codeFormation);
            $formation->niveaux = $niveaux;
        }
        return view('welcome')->with('formations',$formations);
    }
}
