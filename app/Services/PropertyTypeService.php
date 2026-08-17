<?php

namespace App\Services;

use App\Interfaces\PropertyTypeRepositoryInterface;

class PropertyTypeService
{
    protected $propertyTypeRepository;

    public function __construct(PropertyTypeRepositoryInterface $propertyTypeRepository)
    {
        $this->propertyTypeRepository = $propertyTypeRepository;
    }

    public function getAll($search = null)
    {
        return $this->propertyTypeRepository->getAll($search);
    }

    public function store(array $data)
    {
        return $this->propertyTypeRepository->store($data);
    }

    public function find($id)
    {
        return $this->propertyTypeRepository->find($id);
    }

    public function update($id, array $data)
    {
        return $this->propertyTypeRepository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->propertyTypeRepository->delete($id);
    }
}