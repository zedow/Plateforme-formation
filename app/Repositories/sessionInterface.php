<?php

namespace App\Repositories;


interface sessionInterface
{
    public function all();
    public function getPaginate($nb);
    public function getById($id);
}
