<?php

namespace App\Repositories;

use App\Interfaces\PropertyTypeRepositoryInterface;
use App\Models\PropertyType;
use Illuminate\Support\Str;

class PropertyTypeRepository implements PropertyTypeRepositoryInterface
{
    public function getAll($search = null)
    {
        return PropertyType::when($search, function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10);
    }

    public function store(array $data)
    {
        $data['slug'] = Str::slug($data['name']);

        return PropertyType::create($data);
    }

    public function find($id)
    {
        return PropertyType::findOrFail($id);
    }

    public function update($id, array $data)
    {
        $propertyType = $this->find($id);

        $data['slug'] = Str::slug($data['name']);

        $propertyType->update($data);

        return $propertyType;
    }

    public function delete($id)
    {
        return $this->find($id)->delete();
    }
}