<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('oldpassword', function ($attribute, $value, $parameters, $validator) {
            return Hash::Check($value,Auth::user()->password);
        });
        
        Validator::replacer('oldpassword', function ($message, $attribute, $rule, $parameters) {
            return str_replace($message,'Mot de passe incorrecte.',$message);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
		'App\Gestion\QueryInterface', 
		'App\Gestion\QueryGestion'
	);
        
        $this->app->bind(
                'App\Repositories\sessionInterface',
                'App\Repositories\r_session'
        );
        
        $this->app->bind(
                'App\Repositories\niveauInterface',
                'App\Repositories\r_niveau'
        );
        
        $this->app->bind(
                'App\Repositories\horaireInterface',
                'App\Repositories\r_horaire'
        );
        
         $this->app->bind(
                'App\Repositories\domaineInterface',
                'App\Repositories\r_domaine'
        );
    }
}
