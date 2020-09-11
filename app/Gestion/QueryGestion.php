<?php

namespace App\Gestion;

class QueryGestion implements QueryInterface
{
    public function civilite($int)
    {
        if($int == 0)
        {
            return 'Mme';
        }
        else
        {
            return 'M';
        }
    }
    
}
