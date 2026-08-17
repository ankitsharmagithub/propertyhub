<?php

namespace App\Services;

use App\Interfaces\AmenityRepositoryInterface;

class AmenityService
{
    protected $amenityRepository;

    public function __construct(AmenityRepositoryInterface $amenityRepository)
    {
        $this->amenityRepository = $amenityRepository;
    }

    public function getAll($search = null)
    {
        return $this->amenityRepository->getAll($search);
    }

    public function store(array $data)
    {
        return $this->amenityRepository->store($data);
    }

    public function find($id)
    {
        return $this->amenityRepository->find($id);
    }

    public function update($id, array $data)
    {
        return $this->amenityRepository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->amenityRepository->delete($id);
    }
}