<?php

namespace App\Interfaces;

interface CityRepositoryInterface
{
    public function getAll($search = null);

    public function store(array $data);

    public function find($id);

    public function update($id, array $data);

    public function delete($id);
}