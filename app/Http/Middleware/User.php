<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\entreprise;

class User
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    protected function redirectProfile()
    {
        flash('Veuillez compléter votre profile afin d\'utiliser nos services');
        return redirect('/profile');
    }
    public function handle($request, Closure $next)
    {
        if(Auth::user()) {
            $user = Auth::user();
            if(!is_null($user->adresse) && !is_null($user->ville) && !is_null($user->cp) && !is_null($user->telClient)) {
                if(!is_null($user->codeEntrepriseClient)) {
                    $ent = entreprise::where('codeEntreprise',$user->codeEntrepriseClient)->first();
                    if(!is_null($ent->adresseEnt) && !is_null($ent->villeEnt) && !is_null($ent->cpEnt)) {
                        return $next($request);
                        
                    }
                    else {
                        $this->redirectProfile();
                    }
                }
                return $next($request);
            }
            else {
                $this->redirectProfile();
            }
        }
        return redirect('/login');
    }
}
