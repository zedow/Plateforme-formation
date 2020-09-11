<?php

namespace App\Http\Controllers\DataControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\sessionInterface;
use App\Http\Requests;
use App\Gestion\QueryInterface;
use Cornford\Googlmapper\Mapper;
use App\Repositories\niveauInterface;
use App\Repositories\r_map;
use App\Repositories\horaireInterface;
use App\Repositories\r_domaine;
use Barryvdh\DomPDF\PDF;
use Illuminate\Support\Facades\Auth;
use App\Repositories\r_entreprise;

class c_session extends Controller
{
    protected $interface;
    protected $nInterface;
    protected $horaireInterface;
    protected $map;
    protected $pdf;
    protected $gestion;
    protected $domaine;
    
    public function __construct(QueryInterface $gestion,sessionInterface $interface,niveauInterface $nInterface,horaireInterface $horaire,
            r_domaine $domaine,PDF $pdf)
    {
        $this->gestion = $gestion;
        $this->interface = $interface;
        $this->nInterface = $nInterface;
        $this->horaireInterface = $horaire;
        $this->domaine = $domaine;
        $this->pdf = $pdf;
        $this->middleware('admin')->except(['index','filter','show','generatePDF']);
        $this->middleware('user')->only(['generatePDF']);
        //$this->map = $mapper;
    }
    
    public function index()
    {
        $formations = $this->interface->getPaginate(6);
        foreach($formations as $formation)
        {
            $niveaux = $this->nInterface->getNiveauxFormation($formation->codeFormation);
            $formation->niveaux = $niveaux;
        }
        $domaines = $this->domaine->all();
        return view('formations')->with(['formations' =>$formations,'domaines'=>$domaines]);
    }
    
    public function filtrer(Request $request)
    {
        if($request->ajax())
        {
            $formations = $this->interface->getPaginate(2);
            return Response(view('affichageFormations')->with('formations',$formations));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    public function show($id)
    {
        $session = $this->interface->getById($id);
        $horaires = $this->horaireInterface->getHoraireSession($id);
        $niveaux = $this->nInterface->getNiveauxFormation($session->codeFormation);
        $session->niveaux = $niveaux;
        $session->horaires = $horaires;
        // $this->map->getLocation('3 route de la roche');
        return view('session')->with('session',$session);
    }
    
    public function generatePDF($id,r_entreprise $entreprise)
    {
        $session = $this->interface->getById($id);
        $niveaux = $this->nInterface->getNiveauxFormation($session->codeFormation);
        $session->niveaux = $niveaux;
        $session->user = Auth::user();
        $session->entreprise = $entreprise->getByClient(Auth::id());
        $session->user->civClient = $this->gestion->civilite($session->user->civClient);
        $pdf = $this->pdf->loadView('devis', compact('session'));
        $name = "Devis-".str_replace(' ', '_', $session->libelleFormation).".pdf";
        return $pdf->stream($name);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
