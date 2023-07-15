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
        Schema::create('my_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('division_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('district_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('thana_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('photo')->nullable();
            $table->string('address')->nullable();
            $table->string('gender', 10)->nullable();
            $table->string('phone',15)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('my_profiles');
    }
};
