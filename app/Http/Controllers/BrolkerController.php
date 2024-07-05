<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBrokerRequest;
use App\Http\Resources\BrokerResource;
use App\Models\Broker;
use Illuminate\Http\Request;

class BrolkerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return BrokerResource::collection(Broker::all());

    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBrokerRequest $storeBrokerRequest)
    {
        $storeBrokerRequest->validated();

        $broker =  Broker::create([
            'name' => $storeBrokerRequest->name,
            'address' => $storeBrokerRequest->address,
            'city' => $storeBrokerRequest->city,
            'zip_code' => $storeBrokerRequest->zip_code,
            'phone_number'=> $storeBrokerRequest->phone_number,
            'logo_path' => $storeBrokerRequest->logo_path

        ]);

        return new BrokerResource($broker);

        }

    /**
     * Display the specified resource.
     */
    public function show(Broker $broker)
    {
        return new BrokerResource($broker);

    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Broker $broker)
    {
        $broker->update($request->only([
            'name', 'address', 'city', 'zip_code', 'phone_nmber', 'logo_path'

        ]));


        return new BrokerResource($broker);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
