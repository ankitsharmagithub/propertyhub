<?php

namespace App\Repositories;

use App\Interfaces\AmenityRepositoryInterface;
use App\Models\Amenity;

class AmenityRepository implements AmenityRepositoryInterface
{
    public function getAll($search = null)
    {
        return Amenity::when($search, function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10);
    }

    public function store(array $data)
    {
        return Amenity::create($data);
    }

    public function find($id)
    {
        return Amenity::findOrFail($id);
    }

    public function update($id, array $data)
    {
        $amenity = $this->find($id);

        $amenity->update($data);

        return $amenity;
    }

    public function delete($id)
    {
        return $this->find($id)->delete();
    }
}