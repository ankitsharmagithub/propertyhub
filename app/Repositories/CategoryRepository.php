<?php

namespace App\Repositories;

use App\Models\Category;
use App\Interfaces\CategoryRepositoryInterface;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function getAll($search = null)
    {
        return Category::when($search, function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10);
    }

    public function store(array $data)
{
    $data['slug'] = Str::slug($data['name']);

    if (isset($data['image']) && $data['image']) {
        $data['image'] = $data['image']->store('categories', 'public');
    }

    return Category::create($data);
}

    public function find($id)
    {
        return Category::findOrFail($id);
    }

   public function update($id, array $data)
{
    $category = $this->find($id);

    $data['slug'] = Str::slug($data['name']);

    if (isset($data['image']) && $data['image']) {

        if ($category->image && Storage::disk('public')->exists($category->image)) {
            Storage::disk('public')->delete($category->image);
        }

        $data['image'] = $data['image']->store('categories', 'public');
    }

    $category->update($data);

    return $category;
}

    public function delete($id)
{
    $category = $this->find($id);

    if ($category->image && Storage::disk('public')->exists($category->image)) {
        Storage::disk('public')->delete($category->image);
    }

    return $category->delete();
}
}