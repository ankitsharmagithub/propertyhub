<?php

namespace App\Repositories;

use App\Interfaces\StateRepositoryInterface;
use App\Models\State;
use Illuminate\Support\Str;

class StateRepository implements StateRepositoryInterface
{
    public function getAll($search = null)
    {
        return State::when($search, function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('code', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10);
    }

    public function store(array $data)
    {
        $data['slug'] = Str::slug($data['name']);

        return State::create($data);
    }

    public function find($id)
    {
        return State::findOrFail($id);
    }

    public function update($id, array $data)
    {
        $state = $this->find($id);

        $data['slug'] = Str::slug($data['name']);

        $state->update($data);

        return $state;
    }

    public function delete($id)
    {
        return $this->find($id)->delete();
    }
}