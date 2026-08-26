<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

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
                $this->input('action') === 'publish' ? 'required' : 'nullable',
                'numeric',
                'min:0'
            ],
            'bedrooms' => [
                $this->input('action') === 'publish' ? 'required' : 'nullable',
                'integer',
                'min:0'
            ],
            'bathrooms' => [
                $this->input('action') === 'publish' ? 'required' : 'nullable',
                'integer',
                'min:0'
            ],
            'balconies' => [
                $this->input('action') === 'publish' ? 'required' : 'nullable',
                'integer',
                'min:0'
            ],
            'parking' => [
                $this->input('action') === 'publish' ? 'required' : 'nullable',
                'integer',
                'min:0'
            ],
            'floor' => [
                $this->input('action') === 'publish' ? 'required' : 'nullable',
                'integer',
                'min:0'
            ],
            'total_floors' => [
                $this->input('action') === 'publish' ? 'required' : 'nullable',
                'integer',
                'min:0'
            ],
            'area' => [
                $this->input('action') === 'publish' ? 'required' : 'nullable',
                'numeric',
                'min:0'
            ],
            'area_unit' => [
                $this->input('action') === 'publish' ? 'required' : 'nullable',
                'string',
                'max:100'
            ],
            'listing_type' => [
    $this->input('action') === 'publish' ? 'required' : 'nullable',
    Rule::in([
        'sale',
        'rent',
        'lease',
    ]),
],
            'developer_id' => [
    $this->input('action') === 'publish' ? 'required' : 'nullable',
    'exists:developers,id',
],

'project_status' => [
    $this->input('action') === 'publish' ? 'required' : 'nullable',
    'string',
    'max:100',
],

'possession_date' => [
    $this->input('action') === 'publish' ? 'required' : 'nullable',
    'date',
],

'rera_number' => [
    $this->input('action') === 'publish' ? 'required' : 'nullable',
    'string',
    'max:255',
],

'rera_status' => [
    $this->input('action') === 'publish' ? 'required' : 'nullable',
    'string',
    'max:100',
],
            'address' => [
                $this->input('action') === 'publish' ? 'required' : 'nullable',
                'string',
                'max:255'
            ],
            'pincode' => [
                $this->input('action') === 'publish' ? 'required' : 'nullable',
                'string',
                'max:20'
            ],
            'latitude' => [
                $this->input('action') === 'publish' ? 'required' : 'nullable',
                'numeric'
            ],
            'longitude' => [
                $this->input('action') === 'publish' ? 'required' : 'nullable',
                'numeric'
            ],
            'featured_image' => [
                $this->isMethod('post') ? 'required' : 'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048'
            ],
            'images' => [
                $this->input('action') === 'publish' ? 'required' : 'nullable',
                'array',
                'max:20'
            ],
            'images.*' => [
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048'
            ],
            'delete_gallery' => 'nullable|array',
            'delete_gallery.*' => 'integer|exists:property_images,id',
            'amenities' => [
                $this->input('action') === 'publish' ? 'required' : 'nullable',
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
    $this->input('action') === 'publish' ? 'required' : 'nullable',
    'array',
],

'specifications.*.title' => [
    $this->input('action') === 'publish' ? 'required' : 'nullable',
    'string',
    'max:255',
],

'specifications.*.value' => [
    $this->input('action') === 'publish' ? 'required' : 'nullable',
    'string',
    'max:1000',
],

'specifications.*.description' => [
    $this->input('action') === 'publish' ? 'required' : 'nullable',
    'string',
    'max:2000',
],

'specifications.*.sort_order' => [
    $this->input('action') === 'publish' ? 'required' : 'nullable',
    'integer',
    'min:0',
],

'specifications.*.status' => [
    $this->input('action') === 'publish' ? 'required' : 'nullable',
    'boolean',
],
/*
|--------------------------------------------------------------------------
| Floor Plans
|--------------------------------------------------------------------------
*/

'floor_plans' => [
    $this->input('action') === 'publish' ? 'required' : 'nullable',
    'array',
],
'floor_plans.*.id' => 'nullable|integer',

'floor_plans.*.title' => [
    $this->input('action') === 'publish' ? 'required' : 'nullable',
    'string',
    'max:255',
],

'floor_plans.*.configuration' => [
    $this->input('action') === 'publish' ? 'required' : 'nullable',
    'string',
    'max:255',
],

'floor_plans.*.area' => [
    $this->input('action') === 'publish' ? 'required' : 'nullable',
    'numeric',
    'min:0',
],

'floor_plans.*.area_unit' => [
    $this->input('action') === 'publish' ? 'required' : 'nullable',
    'string',
    'max:100',
],

'floor_plans.*.price' => [
    $this->input('action') === 'publish' ? 'required' : 'nullable',
    'numeric',
    'min:0',
],

'floor_plans.*.image' => [
    $this->input('action') === 'publish' ? 'required' : 'nullable',
    'image',
    'mimes:jpg,jpeg,png,webp',
    'max:2048',
],

'floor_plans.*.sort_order' => [
    $this->input('action') === 'publish' ? 'required' : 'nullable',
    'integer',
    'min:0',
],

'floor_plans.*.status' => [
    $this->input('action') === 'publish' ? 'required' : 'nullable',
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
    $this->input('action') === 'publish' ? 'required' : 'nullable',
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
    protected function failedValidation(Validator $validator)
{
    $key = $this->isAdminPropertyRequest()
        ? 'admin_property_draft'
        : 'user_property_draft';

    $draft = $this->except([
        'featured_image',
        'images',
        'floor_plans',
    ]);

    session([
        $key => $draft,
        $key . '_expires' => now()->addHours(3),
    ]);

    throw new HttpResponseException(
        redirect()
            ->back()
            ->withErrors($validator)
            ->withInput()
    );
}

private function isAdminPropertyRequest(): bool
{
    return $this->routeIs('admin.properties.*');
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
