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
        Schema::create('restaurant_owner_profiles', function (Blueprint $table) {
            $table->id();
            //1 to 1 rlt with users
            $table->foreignId('user_id')->unique()->constrained('users')->cascadeOnDelete();
            // owner must be verified by admin before allowed to create restaurents
            $table->enum('kyc_status',['pending','verified','rejected']);//->default('pending');
            $table->string('image');
            $table->timestamps();
        });
    }

    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restsurent_owner_profiles');
    }
};
