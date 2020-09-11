<?php

namespace App\Repositories;

use App\User;

class r_user extends r_repository
{
    public function __construct(User $user) {
        $this->model = $user;
    }
    
    public function entreprise($id)
    {
        return $this->model->find($id)->entreprise;
    }
    
    public function update($id, Array $inputs)
    {
        return $this->getById($id)->update($inputs);
    }
    
}
