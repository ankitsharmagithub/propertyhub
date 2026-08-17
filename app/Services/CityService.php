<?php

namespace App\Services;

use App\Interfaces\CityRepositoryInterface;

class CityService
{
    protected $cityRepository;

    public function __construct(CityRepositoryInterface $cityRepository)
    {
        $this->cityRepository = $cityRepository;
    }

    public function getAll($search = null)
    {
        return $this->cityRepository->getAll($search);
    }

    public function store(array $data)
    {
        return $this->cityRepository->store($data);
    }

    public function find($id)
    {
        return $this->cityRepository->find($id);
    }

    public function update($id, array $data)
    {
        return $this->cityRepository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->cityRepository->delete($id);
    }
}