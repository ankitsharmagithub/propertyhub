<?php

namespace App\Services;

use App\Interfaces\CategoryRepositoryInterface;

class CategoryService
{
    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getAll($search = null)
    {
        return $this->categoryRepository->getAll($search);
    }

    public function store(array $data)
    {
        return $this->categoryRepository->store($data);
    }

    public function find($id)
    {
        return $this->categoryRepository->find($id);
    }

    public function update($id, array $data)
    {
        return $this->categoryRepository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->categoryRepository->delete($id);
    }
}