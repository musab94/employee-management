<?php

namespace App\Repositories\Interfaces;

interface RepositoryInterface
{
    public  function getAll();

    public function create($data);

    public function getById($id);

    public function update($data, $id);

    public function delete($id);
}
