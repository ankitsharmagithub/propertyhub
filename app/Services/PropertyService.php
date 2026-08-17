<?php

namespace App\Services;

use App\Interfaces\PropertyRepositoryInterface;

class PropertyService
{
    protected $propertyRepository;

    public function __construct(
        PropertyRepositoryInterface $propertyRepository
    ) {
        $this->propertyRepository = $propertyRepository;
    }

    /**
     * Get all properties
     */
    public function getAll(
        $search = null,
        $userId = null
    ) {
        return $this->propertyRepository->getAll(
            $search,
            $userId
        );
    }

    /**
     * Store property
     */
    public function store(array $data)
    {
        return $this->propertyRepository->store($data);
    }

    /**
     * Find property
     */
    public function find(
        $id,
        $userId = null
    ) {
        return $this->propertyRepository->find(
            $id,
            $userId
        );
    }

    /**
     * Update property
     */
    public function update(
        $id,
        array $data,
        $userId = null
    ) {
        return $this->propertyRepository->update(
            $id,
            $data,
            $userId
        );
    }

    /**
     * Delete property
     */
    public function delete(
        $id,
        $userId = null
    ) {
        return $this->propertyRepository->delete(
            $id,
            $userId
        );
    }
}