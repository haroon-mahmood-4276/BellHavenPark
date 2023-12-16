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
        Schema::table('cabins', function (Blueprint $table) {
            $table->boolean('gas_meter')->after('electric_meter')->default(false);
            $table->boolean('water_meter')->after('electric_meter')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cabins', function (Blueprint $table) {
            $table->dropColumn(['gas_meter', 'water_meter']);
        });
    }
};
