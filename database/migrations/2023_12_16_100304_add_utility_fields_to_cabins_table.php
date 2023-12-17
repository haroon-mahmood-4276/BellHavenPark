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
            $table->boolean('gas_meter')->default(false)->after('electric_meter');
            $table->boolean('water_meter')->default(false)->after('electric_meter');
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
