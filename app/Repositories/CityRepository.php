<?php

namespace App\Repositories;

use App\Interfaces\CityRepositoryInterface;
use App\Models\City;
use Illuminate\Support\Str;

class CityRepository implements CityRepositoryInterface
{
    public function getAll($search = null)
    {
        return City::with('state')
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10);
    }

    public function store(array $data)
    {
        $data['slug'] = Str::slug($data['name']);

        return City::create($data);
    }

    public function find($id)
    {
        return City::findOrFail($id);
    }

    public function update($id, array $data)
    {
        $city = $this->find($id);

        $data['slug'] = Str::slug($data['name']);

        $city->update($data);

        return $city;
    }

    public function delete($id)
    {
        return $this->find($id)->delete();
    }
}