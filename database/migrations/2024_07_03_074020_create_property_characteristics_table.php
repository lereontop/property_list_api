<?php

use App\Enums\PropertyStatusEnum;
use App\Enums\PropertyTypeEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('property_characteristics', function (Blueprint $table) {
            $table->unsignedBigInteger('property_id');
            $table->float('price')->required();
            $table->integer('bedrooms')->require();
            $table->integer('bathrooms')->require();
            $table->float('sqft')->require();
            $table->float('price_sqft')->require();


            $table->enum('property_type', [
                PropertyTypeEnum::SINGLE->value,
                PropertyTypeEnum::TOWNHOUSE->value,
                PropertyTypeEnum::MULTIFAMILY->value,
                PropertyTypeEnum::BUNGALOW->value
            ]);

            $table->enum('status', [
                PropertyStatusEnum::SALE->value,
                PropertyStatusEnum::SOLD->value,
                PropertyStatusEnum::HOLD->value
            ])->required();

            $table->timestamps();

            $table->foreign('property_id')->references('id')->on('properties')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_characteristics');
    }
};
