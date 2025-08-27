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
        Schema::create('options', function (Blueprint $table) {
            $table->id();
            
    // Each option belongs to one option group
    $table->foreignId('option_group_id')->constrained('option_groups')->cascadeOnDelete();
    $table->string('name');// "Large", "Extra Cheese", "Pepsi"
    $table->decimal('price_delta', 10, 2)->default(0); // +/- change to dish base price
    $table->boolean('is_available')->default(true);
    $table->unsignedSmallInteger('position')->default(1);
    $table->unique(['option_group_id', 'name']);// Prevent duplicate option names within the same group (optional but useful)
    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('options');
    }
};
