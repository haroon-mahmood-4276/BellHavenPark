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
        Schema::create('asset_cabins', function (Blueprint $table) {
            $table->foreignId('cabin_asset_id')->constrained();
            $table->foreignId('cabin_id')->constrained();
            $table->unsignedInteger('install_date')->default(0);
            $table->unsignedInteger('service_date')->default(0);
            $table->unsignedInteger('expire_date')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asset_cabins');
    }
};
