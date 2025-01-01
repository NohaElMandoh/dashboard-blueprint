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
        Schema::create('repositories', function (Blueprint $table) {
            $table->id();
            $table->json('name');
            $table->json('description')->nullable();
            $table->unsignedBigInteger('city_id');
            $table->unsignedBigInteger('type_id');
            $table->boolean('verified')->default(false);
            $table->string('status');
            $table->json('location');
            $table->string('map');
            $table->string('main_photo')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->string('area');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repositories');
    }
};
