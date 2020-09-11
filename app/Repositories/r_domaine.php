<?php

namespace App\Repositories;

use App\domaine;

class r_domaine extends r_repository
{
    public function __construct(domaine $domaine)
    {
        $this->model = $domaine;
    }
}

