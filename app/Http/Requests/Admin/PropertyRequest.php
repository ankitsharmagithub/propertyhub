<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PropertyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        $propertyId = $this->route('property');
        return [
            'category_id'        => ['required', 'exists:categories,id'],
            'property_type_id'   => ['required', 'exists:property_types,id'],
            'state_id'           => ['required', 'exists:states,id'],
            'city_id'            => ['required', 'exists:cities,id'],
            'title' => [
                'required',
                'string',
                'max:255'
            ],
            'slug' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('properties', 'slug')->ignore($propertyId),
            ],
            'short_description' => [
                'nullable',
                'string'
            ],
            'description' => [
                'required',
                'string'
            ],
            'price' => [
                'required',
                'numeric',
                'min:0'
            ],
            'bedrooms' => [
                'nullable',
                'integer',
                'min:0'
            ],
            'bathrooms' => [
                'nullable',
                'integer',
                'min:0'
            ],
            'balconies' => [
                'nullable',
                'integer',
                'min:0'
            ],
            'parking' => [
                'nullable',
                'integer',
                'min:0'
            ],
            'floor' => [
                'nullable',
                'integer',
                'min:0'
            ],
            'total_floors' => [
                'nullable',
                'integer',
                'min:0'
            ],
            'area' => [
                'nullable',
                'numeric',
                'min:0'
            ],
            'area_unit' => [
                'required',
                'string',
                'max:100'
            ],
            'listing_type' => [
    'required',
    Rule::in([
        'sale',
        'rent',
        'lease',
    ]),
],
            'developer_id' => [
    'nullable',
    'exists:developers,id',
],

'project_status' => [
    'nullable',
    'string',
    'max:100',
],

'possession_date' => [
    'nullable',
    'date',
],

'rera_number' => [
    'nullable',
    'string',
    'max:255',
],

'rera_status' => [
    'nullable',
    'string',
    'max:100',
],
            'address' => [
                'required',
                'string',
                'max:255'
            ],
            'pincode' => [
                'nullable',
                'string',
                'max:20'
            ],
            'latitude' => [
                'nullable',
                'numeric'
            ],
            'longitude' => [
                'nullable',
                'numeric'
            ],
            'featured_image' => [
                $this->isMethod('post') ? 'required' : 'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048'
            ],
            'images' => [
                'nullable',
                'array',
                'max:20'
            ],
            'images.*' => [
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048'
            ],
            'amenities' => [
                'nullable',
                'array'
            ],
            'amenities.*' => [
                'exists:amenities,id'
            ],
            /*
|--------------------------------------------------------------------------
| Specifications
|--------------------------------------------------------------------------
*/

'specifications' => [
    'nullable',
    'array',
],

'specifications.*.title' => [
    'nullable',
    'string',
    'max:255',
],

'specifications.*.value' => [
    'nullable',
    'string',
    'max:1000',
],

'specifications.*.description' => [
    'nullable',
    'string',
    'max:2000',
],

'specifications.*.sort_order' => [
    'nullable',
    'integer',
    'min:0',
],

'specifications.*.status' => [
    'nullable',
    'boolean',
],
/*
|--------------------------------------------------------------------------
| Floor Plans
|--------------------------------------------------------------------------
*/

'floor_plans' => [
    'nullable',
    'array',
],

'floor_plans.*.title' => [
    'nullable',
    'string',
    'max:255',
],

'floor_plans.*.configuration' => [
    'nullable',
    'string',
    'max:255',
],

'floor_plans.*.area' => [
    'nullable',
    'numeric',
    'min:0',
],

'floor_plans.*.area_unit' => [
    'nullable',
    'string',
    'max:100',
],

'floor_plans.*.price' => [
    'nullable',
    'numeric',
    'min:0',
],

'floor_plans.*.image' => [
    'nullable',
    'image',
    'mimes:jpg,jpeg,png,webp',
    'max:2048',
],

'floor_plans.*.sort_order' => [
    'nullable',
    'integer',
    'min:0',
],

'floor_plans.*.status' => [
    'nullable',
    'boolean',
],
            'meta_title' => [
                'nullable',
                'string',
                'max:255'
            ],
            'meta_description' => [
                'nullable',
                'string'
            ],
            
            'availability' => [
    'required',
    Rule::in([
        'available',
        'unavailable',
    ])
],
            'featured' => [
                'required',
                'boolean'
            ],
            'status' => [
                'required',
                'boolean'
            ],
        ];
    }
    public function messages(): array
    {
        return [
            'category_id.required'       => 'Please select category.',
            'property_type_id.required'  => 'Please select property type.',
            'state_id.required'          => 'Please select state.',
            'city_id.required'           => 'Please select city.',
            'title.required'             => 'Property title is required.',
            'description.required'       => 'Property description is required.',
            'price.required'             => 'Property price is required.',
            'address.required'           => 'Property address is required.',
            'featured_image.required'    => 'Featured image is required.',
        ];
    }
}