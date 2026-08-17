<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\PropertyImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class PropertyImageController extends Controller
{

    public function store(Request $request, Property $property)
    {

        $request->validate([
            'images' => 'required|array|min:1',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);


        DB::beginTransaction();

        $uploadedFiles = [];


        try {


            $sort = PropertyImage::where('property_id',$property->id)
                    ->max('sort_order') ?? 0;


            foreach ($request->file('images', []) as $image) {


                $filename = Str::uuid()
                    .'.'
                    .$image->getClientOriginalExtension();



                $image->storeAs(
                    'properties/gallery',
                    $filename,
                    'public'
                );


                $uploadedFiles[] = $filename;


                $sort++;


                PropertyImage::create([
                    'property_id'=>$property->id,
                    'image'=>$filename,
                    'sort_order'=>$sort,
                ]);

            }


            DB::commit();


        } catch(\Exception $e){


            DB::rollBack();


            foreach($uploadedFiles as $file){

                Storage::disk('public')
                    ->delete('properties/gallery/'.$file);

            }


            throw $e;

        }


        return back()->with(
            'success',
            'Gallery images uploaded successfully.'
        );

    }



    public function destroy(PropertyImage $image)
    {

        if (
            $image->image &&
            Storage::disk('public')
            ->exists('properties/gallery/'.$image->image)
        ) {


            Storage::disk('public')
                ->delete('properties/gallery/'.$image->image);

        }


        $image->delete();


        return back()->with(
            'success',
            'Image deleted successfully.'
        );

    }

}