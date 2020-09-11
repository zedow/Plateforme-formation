<?php

namespace App\Http\Controllers\DataControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\r_user;
use Illuminate\Support\Facades\Auth;
use App\Repositories\r_entreprise;
use App\Repositories\r_adresse;
use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Validator as valid;
use Illuminate\View\View;

class c_user extends Controller
{
    protected $user;
    protected $entreprise;
    protected $adresse;
    
    public function __construct(r_user $user,r_entreprise $entreprise,r_adresse $adresse)
    {
        $this->middleware('auth')->only(['profile','editProfile','updateProfile','requestToInput']);
        $this->middleware('admin')->except(['profile','editProfile','updateProfile','requestToInput']);
        $this->user = $user;
        $this->entreprise = $entreprise;
        $this->adresse = $adresse;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
   
    public function profile()
    {
        //flash('Veuillez compléter votre profile pour s\'inscrire à une formation!')->error();
        $user = Auth::user();
        if($user->codeEntrepriseClient != null)
        {
            $entreprise = $this->entreprise->getByClient($user->codeClient);
            return view('auth.userProfile')->with(['user'=>$user,'entreprise'=>$entreprise]);
        }
        return view('auth.userProfile')->with('user',$user);
    }
    
    public function editProfile()
    {
        $user = Auth::user();
        if($user->codeEntrepriseClient != null)
        {
            $entreprise = $this->entreprise->getByClient($user->codeClient);
            return view('auth.userProfileEdit')->with(['user'=>$user,'entreprise'=>$entreprise]);
        }
        return view('auth.userProfileEdit')->with('user',$user);
    }
    
    protected function createUser(array $data)
    {
        $input = [
            'nomClient' => $data['name'],
            'prenomClient' => $data['surname'],
            'telClient' => $data['tel'],
            'dateNaissance' => $data['date'],
            'ville' => $data['ville'],
            'cp' => $data['cp'],
            'adresse' => $data['adresse'],
            'compAdresse' => $data['comp'],
            'civClient' => $data['civ']
        ];
        if(!empty($data['password']))
        {
            $password = bcrypt($data['password']);
            array_merge($input,$password);
        }
        return $input;
    }
    
    protected function createEntreprise(array $data)
    {
        return $input = [
            'nomEntreprise' => $data['entreprise'],
            'SIRET' => $data['SIRET'],
            'villeEnt'=> $data['villeEnt'],
            'cpEnt' => $data['cpEnt'],
            'adresseEnt' => $data['adresseEnt'],
            'compEnt' => $data['compEnt'],
            'codeClientEntreprise' => Auth::id(),
        ];
    }
    protected function passwordValidator(array $data)
    {
        if(!empty($data['password']))
        {
            return $rule = [
                'oldpassword' => 'required_with:password|oldpassword',
                'password' => 'min:6|confirmed|different:oldpassword',
            ];
        }
        else
        {
            return $rule = [];
        }
    }
    protected function validator(array $data)
    {
        $message = ['password.different' => 'Votre nouveau mot de passe doit être différent de votre mot de passe actuel.'];
        return Validator::make($data, array_merge([
            'name' => 'required|max:255',
            'surname' => 'required|max:255',
            'civ' => 'required|boolean',
            'SIRET' => 'max:14',
            'entreprise' => 'max:255',
            'villeEnt' => 'max:255',
            'cpEnt' => 'max:5',
            'adresseEnt' => 'max:255',
            'compEnt' => 'max: 255',
            'ville' => 'max: 255',
            'date' => 'date',
            'comp' => 'max:255',
            'adresse' => 'max:255',
            'telClient' => 'max: 255'
        ],$this->passwordValidator($data)),$message);
    }
        
    protected function validatorError(valid $validator)
    {
        if ($validator->fails()) {
            return redirect('profile/edit')
                ->withErrors($validator)
                ->withInput();
        }
    }
    public function updateProfile(Request $request)
    {
        $inputs = $request->all();
        $validator = $this->validator($inputs);
        $this->validatorError($validator);
        $inputUser = $this->createUser($inputs);
        if(isset($inputs['entreprise'])) {
            $this->entreprise->store($this->createEntreprise($inputs));
        }
        $this->user->update(Auth::id(),$inputUser);
        flash('Votre compte a été mis à jour avec succès');
        return redirect('/profile');    
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
