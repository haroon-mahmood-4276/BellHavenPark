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
            $table->after('four_weekly_rate', function (Blueprint $table) {
                $table->unsignedInteger('rooms')->default(0);
                $table->unsignedInteger('single_bed')->default(0);
                $table->unsignedInteger('double_bed')->default(0);
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cabins', function (Blueprint $table) {
            $table->dropColumn(['rooms', 'single_bed', 'double_bed']);
        });
    }
};
