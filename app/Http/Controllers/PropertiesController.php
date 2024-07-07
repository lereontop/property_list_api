<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePropertyRequest;
use App\Http\Resources\PropertiesResource;
use App\Models\Property;
use Illuminate\Http\Request;

use function PHPUnit\Framework\returnSelf;

class PropertiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return PropertiesResource::collection(Property::all());
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePropertyRequest $storePropertyRequest)
    {
        $storePropertyRequest->validated();

        $property = Property::create([
            'broker_id' =>$storePropertyRequest->broker_id,
            'address'=>$storePropertyRequest->address,
            'listing_type'=>$storePropertyRequest->listing_type,
            'city'=> $storePropertyRequest->city,
            'zip_code' =>$storePropertyRequest->zip_code,
            'description'=>$storePropertyRequest->description,
            'build_year'=>$storePropertyRequest->build_year,
        ]);


        $property->characteristic()->create([
            'property_id' =>$storePropertyRequest->property_id,
            'price' =>$storePropertyRequest->price,
            'bedrooms' =>$storePropertyRequest->bedrooms,
            'bathrooms' =>$storePropertyRequest->bathrooms,
            'sqft' =>$storePropertyRequest->sqft,
            'price_sqft' =>$storePropertyRequest->price_sqft,
            'property_type' =>$storePropertyRequest->property_type,
            'status' =>$storePropertyRequest->status,

        ]);

        return new PropertiesResource($property);
    }

    /**
     * Display the specified resource.
     */
    public function show(Property $property)
    {
        return new PropertiesResource($property);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Property $property)
    {
        $property->update($request->only([
            'broker_id',
            'address' ,
            'listing_type' ,
            'city',
            'zip_code' ,
            'description' ,
            'build_year' ,

        ]));

        $property->characteristic()->where('property_id', $property->id )->update($request->only([
            'property_id',
            'price' ,
            'bedrooms' ,
            'bathrooms' ,
            'sqft',
            'price_sqft' ,
            'property_type' ,
            'status'
        ]));


        return new PropertiesResource($property);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
    {
        $property->delete();
        return response()->json([
            'success'=> true,
            'message' => 'Property has been deleted from database'
        ]);

    }
}
