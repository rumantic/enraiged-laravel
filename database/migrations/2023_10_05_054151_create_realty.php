<?php

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
        Schema::create('realty', function (Blueprint $table) {
            $table->id();
            $table->longText('text');
            $table->unsignedDecimal('price');
            $table->boolean('active');
            $table->unsignedInteger('room_count');
            $table->unsignedInteger('floor');
            $table->unsignedInteger('floor_count');
            $table->unsignedDecimal('square_all');
            $table->unsignedDecimal('square_live');
            $table->unsignedDecimal('square_kitchen');
            $table->unsignedDecimal('land_area');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('realty');
    }
};
