<?php

namespace App\Services;

use App\Interfaces\StateRepositoryInterface;

class StateService
{
    protected $stateRepository;

    public function __construct(StateRepositoryInterface $stateRepository)
    {
        $this->stateRepository = $stateRepository;
    }

    public function getAll($search = null)
    {
        return $this->stateRepository->getAll($search);
    }

    public function store(array $data)
    {
        return $this->stateRepository->store($data);
    }

    public function find($id)
    {
        return $this->stateRepository->find($id);
    }

    public function update($id, array $data)
    {
        return $this->stateRepository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->stateRepository->delete($id);
    }
}