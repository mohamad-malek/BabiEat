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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            // user-ID ->null -> branch / not null its for a costumer
            $table->foreignId('user_id')->nullable()->constrained('users')->cascadeOnDelete();
            $table->string('label')->nullable(); //work / home
            $table->string('street');
            $table->string('building');
            $table->string('city');
            $table->string('area')->nullable();
            $table->decimal('lat',10,7);//gps latitude
            $table->decimal('lng',10,7);//gps longitude
             $table->string('note')->nullable(); // extra note
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
