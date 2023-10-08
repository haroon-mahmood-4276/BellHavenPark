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
        Schema::table('bookings', function (Blueprint $table) {
            $table->renameColumn('monthly_rate', 'four_weekly_rate');
            $table->renameColumn('monthly_less_booking_percentage', 'four_weekly_less_booking_percentage');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->renameColumn('four_weekly_rate', 'monthly_rate');
            $table->renameColumn('four_weekly_less_booking_percentage', 'monthly_less_booking_percentage');
        });
    }
};
