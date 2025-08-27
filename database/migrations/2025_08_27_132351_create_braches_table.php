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
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('restaurant_id')->unique()->constrained('restaurants')->cascadeOnDelete();
            $table->foreignId('address_id')->unique()->constrained('addresses')->restrictOnDelete();
            $table->string('branch_name');
            $table->string('phone');
            $table->boolean('is_open')->default(1);
            $table->decimal('de;ivery_radius',5,4)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('braches');
    }
};
