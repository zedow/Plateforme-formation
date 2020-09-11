<?php

namespace App\Repositories;

abstract class r_repository
{

    protected $model;

    public function getPaginate($n)
    {
        return $this->model->paginate($n);
    }

    public function store(Array $inputs)
    {
        return $this->model->create($inputs);
    }

    public function getById($id)
    {
        return $this->model->findOrFail($id);
    }

    public function update($id, Array $inputs)
    {
        return $this->getById($id)->update($inputs);
    }
    
    public function all()
    {
        return $this->model->all();
    }

    public function destroy($id)
    {
        return $this->getById($id)->delete();
    }

}

