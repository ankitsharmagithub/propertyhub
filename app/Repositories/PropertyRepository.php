<?php

namespace App\Repositories;

use App\Interfaces\PropertyRepositoryInterface;
use App\Models\Property;
use App\Models\PropertyFloorPlan;
use App\Models\PropertyImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PropertyRepository implements PropertyRepositoryInterface
{
    /**
     * Get all properties with optional search and user filter.
     */
    public function getAll($search = null, $userId = null)
    {
        $query = Property::with([
            'category',
            'propertyType',
            'state',
            'city'
        ]);

        if ($userId) {
            $query->where('user_id', $userId);
        }

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('property_code', 'like', "%{$search}%");
            });
        }

        return $query->latest()->paginate(10);
    }

    /**
     * Find a single property by ID, with optional user ownership check.
     */
    public function find($id, $userId = null)
    {
        $query = Property::with([
            'category',
            'propertyType',
            'state',
            'city',
            'amenities',
            'images',
            'developer',
            'floorPlans',
            'paymentPlans',
            'specifications',
            'landmarks',
            'documents'
        ]);

        if ($userId) {
            $query->where('user_id', $userId);
        }

        return $query->findOrFail($id);
    }

    /**
     * Store a new property.
     */
    public function store(array $data)
    {
        // Ensure user is authenticated
        if (!Auth::check()) {
            throw new \Exception('User must be logged in to create a property.');
        }

        DB::beginTransaction();

        // Track all uploaded files for rollback on failure
        $uploadedFiles = [];

        try {
            // Remove amenities before mass assignment
            $amenities = $data['amenities'] ?? [];
            unset($data['amenities']);

            // Extract and remove nested relations
            $specifications = $data['specifications'] ?? [];
            unset($data['specifications']);

            $galleryImages = $data['images'] ?? [];
            unset($data['images']);

            $floorPlans = $data['floor_plans'] ?? [];
            unset($data['floor_plans']);

            // Generate unique property code
            $data['property_code'] = $this->generatePropertyCode();

            // Generate unique slug
            $data['slug'] = $this->generateUniqueSlug($data['title']);

            $data['user_id'] = Auth::id();

            // Handle featured image
            if (isset($data['featured_image']) && $data['featured_image']) {
                $image = $data['featured_image'];
                $imageName = time() . '_' . $image->getClientOriginalName();
                $path = 'properties/featured/' . $imageName;
                $image->storeAs('properties/featured', $imageName, 'public');
                $data['featured_image'] = $imageName;
                $uploadedFiles[] = $path;
            }

            // Create property
            $property = Property::create($data);

            // Sync amenities
            if (!empty($amenities)) {
                $property->amenities()->sync($amenities);
            }

            // Save specifications
            $this->saveSpecifications($property, $specifications);

            // Save gallery images (track files)
            $this->saveGalleryImages($property, $galleryImages, $uploadedFiles);

            // Save floor plans (track files)
            $this->saveFloorPlans($property, $floorPlans, $uploadedFiles);

            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollBack();

            // Delete all uploaded files
            foreach ($uploadedFiles as $file) {
                if (Storage::disk('public')->exists($file)) {
                    Storage::disk('public')->delete($file);
                }
            }

            throw $e;
        }
    }

    /**
     * Update an existing property.
     */
    public function update($id, array $data, $userId = null)
    {
        DB::beginTransaction();

        $uploadedFiles = [];

        try {
            // Enforce ownership if userId provided
            $query = Property::query();
            if ($userId) {
                $query->where('user_id', $userId);
            }
            $property = $query->findOrFail($id);

            // Remove amenities before update
            $amenities = $data['amenities'] ?? [];
            unset($data['amenities']);

            // Extract relations
            $specifications = $data['specifications'] ?? [];
            unset($data['specifications']);

            $galleryImages = $data['images'] ?? [];
            unset($data['images']);

            $deleteGallery = $data['delete_gallery'] ?? [];
            unset($data['delete_gallery']);

            $floorPlans = $data['floor_plans'] ?? [];
            unset($data['floor_plans']);

            // Generate unique slug (if title changed)
            if (isset($data['title'])) {
                $data['slug'] = $this->generateUniqueSlug($data['title'], $property->id);
            }

            // Handle featured image
            if (isset($data['featured_image']) && $data['featured_image']) {
                // Delete old featured image
                if ($property->featured_image) {
                    $oldPath = 'properties/featured/' . $property->featured_image;
                    if (Storage::disk('public')->exists($oldPath)) {
                        Storage::disk('public')->delete($oldPath);
                    }
                }

                $image = $data['featured_image'];
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->storeAs('properties/featured', $imageName, 'public');
                $data['featured_image'] = $imageName;
                $uploadedFiles[] = 'properties/featured/' . $imageName;
            } else {
                unset($data['featured_image']);
            }

            // Update property
            $property->update($data);

            // Delete selected gallery images
            $this->deleteGalleryImages($property, $deleteGallery);

            // Add new gallery images
            $this->saveGalleryImages($property, $galleryImages, $uploadedFiles);

            // Sync amenities
            $property->amenities()->sync($amenities);

            // Update specifications (delete + recreate)
            $this->updateSpecifications($property, $specifications);

            // Update floor plans (delete + recreate)
            $this->updateFloorPlans($property, $floorPlans, $uploadedFiles);

            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollBack();

            // Clean up newly uploaded files
            foreach ($uploadedFiles as $file) {
                if (Storage::disk('public')->exists($file)) {
                    Storage::disk('public')->delete($file);
                }
            }

            throw $e;
        }
    }

    /**
     * Delete a property and all its related records.
     */
    public function delete($id, $userId = null)
    {
        DB::beginTransaction();

        try {
            $query = Property::with([
                'images',
                'amenities',
                'floorPlans',
                'paymentPlans',
                'landmarks',
                'documents',
                'specifications'
            ]);

            if ($userId) {
                $query->where('user_id', $userId);
            }

            $property = $query->findOrFail($id);

            // Delete featured image
            if ($property->featured_image) {
                $path = 'properties/featured/' . $property->featured_image;
                if (Storage::disk('public')->exists($path)) {
                    Storage::disk('public')->delete($path);
                }
            }

            // Delete gallery images
            foreach ($property->images as $image) {
                if ($image->image) {
                    $path = 'properties/gallery/' . $image->image;
                    if (Storage::disk('public')->exists($path)) {
                        Storage::disk('public')->delete($path);
                    }
                }
                $image->delete();
            }

            // Delete floor plans and their images
            foreach ($property->floorPlans as $floorPlan) {
                if ($floorPlan->image) {
                    $path = 'properties/floor-plans/' . $floorPlan->image;
                    if (Storage::disk('public')->exists($path)) {
                        Storage::disk('public')->delete($path);
                    }
                }
                $floorPlan->delete();
            }

            // Delete payment plans, landmarks, documents, specifications
            $property->paymentPlans()->delete();
            $property->landmarks()->delete();
            $property->documents()->delete();
            $property->specifications()->delete();

            // Detach amenities (many-to-many)
            $property->amenities()->detach();

            // Delete the property itself
            $property->delete();

            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    // ==================== PRIVATE HELPER METHODS ====================

    /**
     * Save gallery images for a property.
     */
    private function saveGalleryImages(Property $property, array $images, array &$uploadedFiles = []): void
    {
        if (empty($images)) {
            return;
        }

        foreach ($images as $index => $image) {
            if (!$image) {
                continue;
            }

            $imageName = time() . '_' . uniqid() . '_' . $image->getClientOriginalName();
            $path = 'properties/gallery/' . $imageName;
            $image->storeAs('properties/gallery', $imageName, 'public');
            $uploadedFiles[] = $path;

            PropertyImage::create([
                'property_id' => $property->id,
                'image'       => $imageName,
                'sort_order'  => $index + 1,
            ]);
        }
    }

    /**
     * Delete selected gallery images.
     */
    private function deleteGalleryImages(Property $property, array $imageIds): void
    {
        if (empty($imageIds)) {
            return;
        }

        $images = $property->images()->whereIn('id', $imageIds)->get();

        foreach ($images as $image) {
            if ($image->image) {
                $path = 'properties/gallery/' . $image->image;
                if (Storage::disk('public')->exists($path)) {
                    Storage::disk('public')->delete($path);
                }
            }
            $image->delete();
        }
    }

    /**
     * Save specifications (create new records).
     */
    private function saveSpecifications(Property $property, array $specifications): void
    {
        foreach ($specifications as $spec) {
            if (empty($spec['title'])) {
                continue;
            }

            $property->specifications()->create([
                'title'       => $spec['title'],
                'value'       => $spec['value'] ?? null,
                'description' => $spec['description'] ?? null,
                'sort_order'  => $spec['sort_order'] ?? 0,
                'status'      => $spec['status'] ?? 1,
            ]);
        }
    }

    /**
     * Update specifications (delete all and recreate).
     */
    private function updateSpecifications(Property $property, array $specifications): void
    {
        $property->specifications()->delete();
        $this->saveSpecifications($property, $specifications);
    }

    /**
     * Save floor plans (create new records).
     */
    private function saveFloorPlans(Property $property, array $floorPlans, array &$uploadedFiles = []): void
    {
        foreach ($floorPlans as $index => $plan) {
            if (empty($plan['title']) && empty($plan['configuration'])) {
                continue;
            }

            $imageName = null;

            if (isset($plan['image']) && $plan['image']) {
                $image = $plan['image'];
                $imageName = time() . '_' . $index . '_' . $image->getClientOriginalName();
                $path = 'properties/floor-plans/' . $imageName;
                $image->storeAs('properties/floor-plans', $imageName, 'public');
                $uploadedFiles[] = $path;
            }

            PropertyFloorPlan::create([
                'property_id'   => $property->id,
                'title'         => $plan['title'] ?? null,
                'configuration' => $plan['configuration'] ?? null,
                'area'          => $plan['area'] ?? null,
                'area_unit'     => $plan['area_unit'] ?? null,
                'price'         => $plan['price'] ?? null,
                'image'         => $imageName,
                'sort_order'    => $plan['sort_order'] ?? ($index + 1),
                'status'        => !empty($plan['status']),
            ]);
        }
    }

    /**
     * Update floor plans (delete all existing and recreate).
     */
    private function updateFloorPlans(Property $property, array $floorPlans, array &$uploadedFiles = []): void
    {
        // Delete old floor plans and their images
        $existing = $property->floorPlans()->get();
        foreach ($existing as $plan) {
            if ($plan->image) {
                $path = 'properties/floor-plans/' . $plan->image;
                if (Storage::disk('public')->exists($path)) {
                    Storage::disk('public')->delete($path);
                }
            }
            $plan->delete();
        }

        // Save new ones
        $this->saveFloorPlans($property, $floorPlans, $uploadedFiles);
    }

    /**
     * Generate a unique property code.
     */
    private function generatePropertyCode(): string
    {
        // Using timestamp + random to avoid race conditions
        return 'PP' . date('YmdHis') . Str::upper(Str::random(4));
    }

    /**
     * Generate a unique slug for a given title, ignoring the current property ID on update.
     */
    private function generateUniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $counter = 1;

        while ($this->slugExists($slug, $ignoreId)) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    /**
     * Check if a slug already exists in the database.
     */
    private function slugExists(string $slug, ?int $ignoreId = null): bool
    {
        $query = Property::where('slug', $slug);
        if ($ignoreId) {
            $query->where('id', '!=', $ignoreId);
        }
        return $query->exists();
    }
}