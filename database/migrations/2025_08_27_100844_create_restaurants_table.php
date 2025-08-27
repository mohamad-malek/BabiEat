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
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('owner_id')->unique()->constrained('restaurent_owner_profiles')->restrictOnDelete();
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('kitchen_type')->nullable();//lebanese/italian...
            $table->enum('status',['active','suspended','pending_review','draft']);
            $table->decimal('rating',3,2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurants');
    }
};
