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
        Schema::create('cabin_assets', function (Blueprint $table) {
            $table->id();

            $table->string('name', 50)->nullable();
            $table->string('slug', 50)->unique();
            $table->boolean('installable')->default(true);
            $table->boolean('serviceable')->default(true);
            $table->boolean('expireable')->default(true);

            $table->unsignedInteger('created_at')->nullable();
            $table->unsignedInteger('updated_at')->nullable();
            $table->unsignedInteger('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cabin_assets');
    }
};
